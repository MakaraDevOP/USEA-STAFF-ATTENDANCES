<?php
    $page_content = "Login";
    $page_title ="Login";
    include('../master/header.php');
?>
<div class="w-full  flex items-center justify-center h-screen">
    <div class="w-full py-8">
        <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-4 mx-auto px-16 py-8 rounded-lg shadow border">
            <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Login</h2>
            <form class="my-8 text-sm" id="submitForm">
                <!-- Mode Action -->
                <input type="hidden" name="mode" value="login">
                <div class="flex flex-col my-4">
                    <label for="email" class="text-gray-700">Username Or Email</label>
                    <input type="email" name="email" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your username" required>
                </div>
                <div class="flex flex-col my-4">
                    <label for="code" class="text-gray-700">Password</label>
                    <input type="text" name="password" id="password" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" required>
                </div>
                <div class="flex  justify-between space-x-3">
                    <div class="my-4 flex items-center justify-end space-x-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $.fn.startloading = function() {
        swal({
            title: "",
            text: "Processing......",
            buttons: false,
            closeOnClickOutside: false,
            timer: 0,
        });
    }
    $.fn.stoploading = function() {
        swal({
            title: "",
            text: "Processing......",
            buttons: false,
            closeOnClickOutside: false,
            timer: 200,
        });
    }
    $('#submitForm').submit(function(e) {
        $.fn.startloading();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/staffAttendence/backend/loginHandler.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                $.fn.stoploading()
                if (typeof response == 'object' && response.error != null) {
                    swal("Errors ", response.error, "error");
                    return;
                }
                if (response) {
                    swal("Successfully ", "Operation was successfully processed ", "success");
                    $('#submitForm')[0].reset();
                    window.setTimeout(document.location = "/staffAttendence/frontend/dashboard", 1000);
                }
            }
        });
    });

    $('#btn-backtolist').click(function() {
        document.location = "/staffAttendence/frontend/department"
    })
});
</script>
<?php
    include('../master/footer.php');
?>