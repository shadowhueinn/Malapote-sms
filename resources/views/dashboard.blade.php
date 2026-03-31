<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniFAST-TDP Scholarship Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f1f5f9; }
        .container { max-width: 1080px; margin: 2rem auto; padding: 1rem; background: #fff; box-shadow: 0 0 12px rgba(0,0,0,.08); border-radius: 8px; }
        h1, h2 { margin: 0.6rem 0; }
        form { display: grid; gap: 0.6rem; margin-bottom: 1rem; }
        label { font-weight: 600; }
        input, select, textarea, button { padding: 0.65rem; border: 1px solid #ccc; border-radius: 5px; }
        button { background:#0f766e; color:#fff; border:none; cursor:pointer; }
        button:hover { background:#115e59; }
        table { width:100%; border-collapse: collapse; margin-top: 0.7rem; }
        th,td { border:1px solid #ddd; padding:0.55rem; text-align:left; }
        th { background:#0f766e; color:#fff; }
        .grid2 { display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:1rem; }
        .notice { background:#dcfce7; border:1px solid #86efac; padding: 0.6rem; border-radius:4px; }
    </style>
</head>
<body>
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div>
                <h1>UniFAST-TDP Scholarship Management System</h1>
                <p>Logged in as: <strong>{{ auth()->user()->name ?? 'N/A' }}</strong> (<em>{{ auth()->user()->role ?? 'guest' }}</em>)</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:#dc2626; border:none; color:white; padding:0.5rem 1rem; border-radius:5px; cursor:pointer;">Logout</button>
            </form>
        </div>

        <h2>1. Scholarship programs</h2>
        <div class="grid2">
            <div>
                <form id="programForm">
                    <label>Name</label><input type="text" id="programName" required>
                    <label>Description</label><textarea id="programDescription"></textarea>
                    <label>Grant Amount</label><input type="number" id="programAmount" required step="0.01">
                    <label>Slots</label><input type="number" id="programSlots" required min="1">
                    <label>Deadline</label><input type="date" id="programDeadline" required>
                    <label>Status</label><select id="programStatus"><option value="open" selected>open</option><option value="closed">closed</option></select>
                    <button type="submit">Create Program</button>
                </form>
            </div>
            <div>
                <table id="programTable">
                    <thead><tr><th>ID</th><th>Name</th><th>Amount</th><th>Slots</th><th>Deadline</th><th>Status</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <h2>2. Applicants</h2>
        <div class="grid2">
            <div>
                <form id="applicantForm">
                    <label>First Name</label><input type="text" id="appFirstName" required>
                    <label>Last Name</label><input type="text" id="appLastName" required>
                    <label>Email</label><input type="email" id="appEmail" required>
                    <label>Contact Number</label><input type="text" id="appContact" required>
                    <label>Address</label><input type="text" id="appAddress" required>
                    <label>Birthdate</label><input type="date" id="appBirthdate" required>
                    <label>School</label><input type="text" id="appSchool" required>
                    <label>Course</label><input type="text" id="appCourse" required>
                    <label>GPA</label><input type="number" id="appGpa" required step="0.01" min="0" max="5">
                    <button type="submit">Create Applicant</button>
                </form>
            </div>
            <div>
                <table id="applicantTable">
                    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>School</th><th>Course</th><th>GPA</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <h2>3. Applications</h2>
        <div class="grid2">
            <div>
                <form id="applicationForm">
                    <label>Applicant ID</label><input type="number" id="applicantId" required>
                    <label>Program ID</label><input type="number" id="programId" required>
                    <button type="submit">Create Application</button>
                </form>
            </div>
            <div>
                <table id="applicationTable">
                    <thead><tr><th>ID</th><th>Applicant</th><th>Program</th><th>Status</th><th>Remarks</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

<script>
const api = '/api';

async function fetchPrograms(){
    const res = await fetch(`${api}/scholarship-programs`);
    const list = await res.json();
    const tbody = document.querySelector('#programTable tbody');
    tbody.innerHTML = '';
    list.forEach(p => tbody.innerHTML += `<tr><td>${p.id}</td><td>${p.name}</td><td>${p.grant_amount}</td><td>${p.slots}</td><td>${p.deadline}</td><td>${p.status}</td></tr>`);
}
async function fetchApplicants(){
    const res = await fetch(`${api}/applicants`);
    const list = await res.json();
    const tbody = document.querySelector('#applicantTable tbody');
    tbody.innerHTML = '';
    list.forEach(a => tbody.innerHTML += `<tr><td>${a.id}</td><td>${a.first_name} ${a.last_name}</td><td>${a.email}</td><td>${a.school}</td><td>${a.course}</td><td>${a.gpa}</td></tr>`);
}
async function fetchApplications(){
    const res = await fetch(`${api}/applications`);
    const list = await res.json();
    const tbody = document.querySelector('#applicationTable tbody');
    tbody.innerHTML = '';
    list.forEach(app => tbody.innerHTML += `<tr><td>${app.id}</td><td>${app.applicant?.first_name || ''} ${app.applicant?.last_name || ''}</td><td>${app.scholarship_program?.name || ''}</td><td>${app.status}</td><td>${app.remarks || ''}</td></tr>`);
}

document.querySelector('#programForm').addEventListener('submit', async e=>{
    e.preventDefault();
    const data = { name:document.getElementById('programName').value, description:document.getElementById('programDescription').value, grant_amount:document.getElementById('programAmount').value, slots:document.getElementById('programSlots').value, deadline:document.getElementById('programDeadline').value, status:document.getElementById('programStatus').value };
    await fetch(`${api}/scholarship-programs`, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)});
    await fetchPrograms();
});

document.querySelector('#applicantForm').addEventListener('submit', async e=>{
    e.preventDefault();
    const data = {
        first_name:document.getElementById('appFirstName').value,
        last_name:document.getElementById('appLastName').value,
        email:document.getElementById('appEmail').value,
        contact_number:document.getElementById('appContact').value,
        address:document.getElementById('appAddress').value,
        birthdate:document.getElementById('appBirthdate').value,
        school:document.getElementById('appSchool').value,
        course:document.getElementById('appCourse').value,
        gpa:document.getElementById('appGpa').value,
    };
    await fetch(`${api}/applicants`, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)});
    await fetchApplicants();
});

document.querySelector('#applicationForm').addEventListener('submit', async e=>{
    e.preventDefault();
    const data = { applicant_id:document.getElementById('applicantId').value, scholarship_program_id:document.getElementById('programId').value };
    await fetch(`${api}/applications`, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)});
    await fetchApplications();
});

(async()=>{ await fetchPrograms(); await fetchApplicants(); await fetchApplications(); })();
</script>
</body>
</html>
