    <?php
    $page_content = "Staff";
    $page_title ="Staff Management : Update";
    require_once('../../backend/auth.php');
    require_once('../../backend/adminAuth.php');
    include('../master/header.php');
    include('../master/navbar.php');
    // include('../../backend/connection.php');
?>
    <div class="bg-gray-100 w-full  flex items-start justify-center h-[calc(100vh-100px)]">
        <div class="w-full py-4">
            <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-4 mx-auto px-16 py-5 rounded-lg shadow">

                <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Update Users</h2>
                <form class="my-8 text-sm" id="submitForm">
                    <!-- Mode Action -->
                    <input type="hidden" name="mode" value="update">
                    <input type="hidden" name="id" value="" id="userID">

                    <div class="flex flex-col my-4">
                        <label for="name" class="text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your name" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="code" class="text-gray-700">Code</label>
                        <input type="text" name="code" id="code" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your code" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="role" class="text-gray-700">Role</label>
                        <select name="role" id="role" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                            <option value="" selected disabled hidden class="text-gray-100">--Select Role--</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="department" class="text-gray-700">Department</label>
                        <select name="department" id="department" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                            <option value="" selected disabled hidden class="text-gray-100">--Select Department--</option>
                        </select>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="email" class="text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your email" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="email" class="text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone">
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="password" class="text-gray-700">Password</label>
                        <div class="relative flex items-center mt-2">
                            <input type="password" name="password" id="password" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" type="password" required>
                        </div>
                    </div>
                    <div class="flex items-start items-center mb-4">
                        <input type="hidden" id="realstatus" name="status" value="0">
                        <input name="" id="status" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
                        <label for="status" class="text-gray-700 px-2">Is Active</label>
                    </div>
                    <div class="flex justify-between space-x-3">
                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button type="button" id="btn-backtolist" class="bg-gray-800 hover:bg-gray-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Back to list</button>
                        </div>
                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Save </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
    $.fn.GetList = function() {
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/departmentHandler.php',
            data: {
                mode: 'list',
            },
            dataType: "json",
            success: function(response) {
                if (response) {
                    $.each(response, function(indexes, data) {
                        $("#department").append(
                            `
                            <option value="${data.id}">${data.name}</option>
                            `
                        );
                    });
                }
            }
        });
    }
    $.fn.GetList();
    /*
    ការចាប់យក​ទិន្នន័យ ពី URL Params
    */
    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    /*
    ការចាប់យក​ទិន្នន័យ ពី URL Params
    */
    const id = $.urlParam('id');
    $.ajax({
        type: "GET",
        url: '/staffAttendence/backend/userHandler.php',
        data: {
            mode: 'edit',
            id: id
        },
        dataType: "json",
        success: function(response) {
            // if (response) {
            console.log(response)
            $('#userID').val(response.id);
            $('#name').val(response.name);
            $('#code').val(response.code);
            $('#role').val(response.role);
            $('#department').val(response.depart_id);
            $('#email').val(response.email);
            $('#phone').val(response.phone);
            $('#password').val(response.password);
            let checked = response.status == 1 ? true : false;
            $('#status').attr('checked', checked);
            $('#realstatus').val(response.status);
        }
    });
    $('#btn-backtolist').click(function() {
        document.location = "/staffAttendence/frontend/user"
    })
    $('#status').click(function() {
        if ($('#realstatus').val() == '1') {
            $('#realstatus').val('0');
            return;
        } else {
            $('#realstatus').val('1');
            return;
        }
    })

    $('#submitForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/staffAttendence/backend/userHandler.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (typeof response == 'object' && response.error != null) {
                    swal("Errors ", response.error, "error");
                    return;
                }
                if (response) {
                    swal("Successfully ", "Operation was successfully processed ", "success");
                }
            }
        });
    });
});
    </script>
    <?php
    $page_content = "index";
    include('../master/footer.php');
?>