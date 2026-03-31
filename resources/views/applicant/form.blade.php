<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniFAST-TDP Application Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-xl rounded-3xl mt-10">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">CHED Regional Office</h1>
            <h2 class="text-2xl font-semibold text-blue-600">UniFAST TULONG DUNONG PROGRAM (UniFAST-TDP)</h2>
            <h3 class="text-xl font-bold text-gray-700 mt-4">APPLICATION FORM</h3>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gray-200 w-32 h-32 rounded-full flex items-center justify-center text-2xl font-bold text-gray-500 mx-auto">
                2x2<br>ID PICTURE
            </div>
        </div>

        <p class="text-sm text-gray-600 mb-8 text-center">Instructions: Read General and Documentary Requirements. Fill in all the required information. Do not leave an item blank. Item is not applicable, indicate "NA".</p>

        <form method="POST" action="{{ route('applicants.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- PERSONAL INFORMATION --}}
            <div class="bg-blue-50 p-6 rounded-2xl">
                <h4 class="text-xl font-bold mb-6 text-blue-800 text-center">PERSONAL INFORMATION</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="first_name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="middle_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maiden Name (for Married Women)</label>
                        <input type="text" name="maiden_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth (mm/dd/yyyy)</label>
                        <input type="date" name="birthdate" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                        <input type="text" name="place_of_birth" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sex</label>
                        <select name="sex" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                        <input type="text" name="citizenship" value="Filipino" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            {{-- ADDRESS --}}
            <div class="bg-green-50 p-6 rounded-2xl">
                <h4 class="text-xl font-bold mb-6 text-green-800 text-center">PERMANENT ADDRESS</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Street & Barangay</label>
                        <input type="text" name="address_street_barangay" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Town/City/Municipality</label>
                        <input type="text" name="address_city" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                        <input type="text" name="address_province" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
                        <input type="text" name="address_zip" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>

            {{-- SCHOOL INFO --}}
            <div class="bg-purple-50 p-6 rounded-2xl">
                <h4 class="text-xl font-bold mb-6 text-purple-800 text-center">EDUCATION</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name of School Attended</label>
                        <input type="text" name="school" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School ID Number</label>
                        <input type="text" name="school_id" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School Address</label>
                        <input type="text" name="school_address" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School Sector</label>
                        <select name="school_sector" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                            <option value="">Select</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                        <input type="text" name="year_level" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                        <input type="tel" name="contact_number" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">E-mail Address</label>
                        <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tribal Membership (if applicable)</label>
                        <input type="text" name="tribal_membership" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of Disability (if applicable)</label>
                    <input type="text" name="disability_type" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            {{-- FAMILY BACKGROUND --}}
            <div class="bg-orange-50 p-6 rounded-2xl">
                <h4 class="text-xl font-bold mb-6 text-orange-800 text-center">FAMILY BACKGROUND</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label>Father:</label>
                        <div class="flex space-x-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="father_living" value="Living" class="mr-1">
                                Living
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="father_living" value="Deceased" class="mr-1">
                                Deceased
                            </label>
                        </div>
                        <input type="text" name="father_name" placeholder="Name" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                        <input type="text" name="father_address" placeholder="Address" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                        <input type="text" name="father_occupation" placeholder="Occupation" class="w-full p-3 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label>Mother:</label>
                        <div class="flex space-x-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="mother_living" value="Living" class="mr-1">
                                Living
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="mother_living" value="Deceased" class="mr-1">
                                Deceased
                            </label>
                        </div>
                        <input type="text" name="mother_name" placeholder="Name" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                        <input type="text" name="mother_address" placeholder="Address" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                        <input type="text" name="mother_occupation" placeholder="Occupation" class="w-full p-3 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Parents Gross Income</label>
                        <input type="number" name="total_parent_income" step="0.01" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. of Siblings in the family</label>
                        <input type="number" name="no_siblings" min="0" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                    </div>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Are you enjoying other educational financial assistance?</label>
                    <label class="flex items-center">
                        <input type="radio" name="has_other_assistance" value="Yes" class="mr-2">
                        Yes
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="has_other_assistance" value="No" checked class="mr-2">
                        No
                    </label>
                    <div class="mt-4 space-y-2">
                        <input type="text" name="assistance_1" placeholder="Specify 1..." class="w-full p-3 border border-gray-300 rounded-lg">
                        <input type="text" name="assistance_2" placeholder="Specify 2..." class="w-full p-3 border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-8 border-t">
                <button type="button" onclick="window.history.back()" class="px-8 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Back</button>
                <button type="submit" class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">Submit Application</button>
            </div>
        </form>

        <div class="mt-12 p-6 bg-yellow-50 border-2 border-dashed border-yellow-300 rounded-2xl">
            <h4 class="text-lg font-bold text-yellow-800 mb-4">Documents Required:</h4>
            <ul class="text-sm text-yellow-800 space-y-1">
                <li>✅ Certificate of Registration/Enrolment (CORs/COEs)</li>
                <li>✅ Certificate of Indigency</li>
            </ul>
        </div>
    </div>
</body>
</html>

