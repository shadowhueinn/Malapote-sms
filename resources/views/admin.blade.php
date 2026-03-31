<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UniFAST-TDP SMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f1f5f9; }
        .header { background:#0f766e; color:#fff; padding:1rem; position:sticky; top:0; z-index:10; }
        .container { max-width: 1400px; margin: 0 auto; padding: 1rem; }
        .nav { display:flex; gap:1rem; }
        h2 { margin: 1.5rem 0 1rem; color:#0f4761; }
        .crud-section { background:#fff; margin-bottom:2rem; padding:1.5rem; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
        .form-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:1rem; margin-bottom:1.5rem; }
        input, select, textarea, button { padding: 0.65rem; border: 1px solid #d1d5db; border-radius: 5px; font-size:1rem; }
        button { background:#0f766e; color:#fff; border:none; cursor:pointer; font-weight:600; }
        button:hover { background:#115e59; }
        table { width:100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border:1px solid #e5e7eb; padding:0.75rem; text-align:left; }
        th { background:#0f766e; color:#fff; font-weight:600; }
        tr:nth-child(even) { background:#f9fafb; }
        .action-btn { padding:0.4rem 0.8rem; margin:0 0.2rem; border-radius:4px; text-decoration:none; font-size:0.85rem; }
        .edit { background:#3b82f6; color:#fff; }
        .delete { background:#ef4444; color:#fff; }
        .notice { background:#dbeafe; border:1px solid #93c5fd; padding:1rem; border-radius:6px; margin-bottom:1rem; }
    </style>
</head>
<body>
    <div class="header">
        <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
            <h1>Admin Dashboard</h1>
            <div class="nav">
                <span>Logged as: <strong>{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#dc2626;">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="notice">
            <strong>Admin Access:</strong> Full CRUD on Programs, Applicants, Applications, Requirements
        </div>

        {{-- 1. Scholarship Programs --}}
        <div class="crud-section">
            <h2>📚 Scholarship Programs</h2>
            <div class="form-grid">
                <input id="progName" placeholder="Program Name" required>
                <input id="progDesc" placeholder="Description">
                <input id="progAmount" type="number" placeholder="Grant Amount" step="0.01" required>
                <input id="progSlots" type="number" placeholder="Slots" required>
                <input id="progDeadline" type="date" required>
                <select id="progStatus">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
                <button onclick="createProgram()">+ Create</button>
            </div>
            <table id="progTable">
                <thead><tr><th>ID</th><th>Name</th><th>Amount</th><th>Slots</th><th>Deadline</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- 2. Applicants --}}
        <div class="crud-section">
            <h2>👤 Applicants</h2>
            <div class="form-grid">
                <input id="appFname" placeholder="First Name" required>
                <input id="appLname" placeholder="Last Name" required>
                <input id="appEmail" type="email" placeholder="Email" required>
                <input id="appContact" placeholder="Contact" required>
                <input id="appSchool" placeholder="School" required>
                <input id="appCourse" placeholder="Course" required>
                <input id="appGpa" type="number" step="0.01" min="0" max="5" placeholder="GPA" required>
                <input id="appBdate" type="date" required>
                <button onclick="createApplicant()">+ Create</button>
            </div>
            <table id="appTable">
                <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>School</th><th>Course</th><th>GPA</th><th>Actions</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- 3. Applications --}}
        <div class="crud-section">
            <h2>📋 Applications</h2>
            <div class="form-grid">
                <input id="appAppId" type="number" placeholder="Applicant ID" required>
                <input id="appProgId" type="number" placeholder="Program ID" required>
                <input id="appStatus" placeholder="Status (pending/approved/rejected)" required>
                <input id="appRemarks" placeholder="Remarks">
                <button onclick="createApplication()">+ Create</button>
            </div>
            <table id="appTableApps">
                <thead><tr><th>ID</th><th>Applicant</th><th>Program</th><th>Status</th><th>Remarks</th><th>Actions</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- 4. Requirements --}}
        <div class="crud-section">
            <h2>📄 Requirements</h2>
            <div class="form-grid">
                <input id="reqProgId" type="number" placeholder="Program ID" required>
                <input id="reqDocName" placeholder="Document Name" required>
                <select id="reqRequired">
                    <option value="1">Required</option>
                    <option value="0">Optional</option>
                </select>
                <button onclick="createRequirement()">+ Create</button>
            </div>
            <table id="reqTable">
                <thead><tr><th>ID</th><th>Program</th><th>Document</th><th>Required</th><th>Actions</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        const API_BASE = '/api';

        // Load all data
        async function loadAll() {
            loadPrograms();
            loadApplicants();
            loadApplications();
            loadRequirements();
        }

        // Programs CRUD
        async function loadPrograms() {
            const res = await fetch(API_BASE + '/scholarship-programs');
            const data = await res.json();
            const tbody = document.querySelector('#progTable tbody');
            tbody.innerHTML = data.map(p => `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.name}</td>
                    <td>$${p.grant_amount}</td>
                    <td>${p.slots}</td>
                    <td>${new Date(p.deadline).toLocaleDateString()}</td>
                    <td><span style="color:${p.status === 'open' ? '#10b981' : '#ef4444'}">${p.status.toUpperCase()}</span></td>
                    <td>
                        <button class="action-btn edit" onclick="editProgram(${p.id})">Edit</button>
                        <button class="action-btn delete" onclick="deleteProgram(${p.id})">Delete</button>
                    </td>
                </tr>
            `).join('');
        }

        async function createProgram() {
            const data = {
                name: document.getElementById('progName').value,
                description: document.getElementById('progDesc').value,
                grant_amount: parseFloat(document.getElementById('progAmount').value),
                slots: parseInt(document.getElementById('progSlots').value),
                deadline: document.getElementById('progDeadline').value,
                status: document.getElementById('progStatus').value
            };
            await fetch(API_BASE + '/scholarship-programs', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            loadPrograms();
            document.getElementById('progForm').reset();
        }

        // Similar functions for other CRUD (edit, delete)
        async function deleteProgram(id) {
            if (confirm('Delete?')) {
                await fetch(API_BASE + '/scholarship-programs/' + id, {method: 'DELETE'});
                loadPrograms();
            }
        }

        // Applicants CRUD (similar pattern)
        async function loadApplicants() {
            // ... implementation
        }

        async function createApplicant() {
            // ... implementation
        }

        // Applications & Requirements (same pattern)

        // Init
        loadAll();
    </script>
</body>
</html>

