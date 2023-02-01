<!-- component -->
<?php
    $page_content = "Staff";
    $page_title ="Staff Profile";
    require_once('../../backend/auth.php');
    require_once('../../backend/connection.php');
    include('../master/header.php');
    include('../master/navbar.php');
?>
<div class="bg-gray-200 font-sans h-[calc(100vh-100px)] w-full flex flex-row justify-center items-center">
    <div class="card w-96 mx-auto bg-white  shadow-xl hover:shadow">
        <img class="w-32 h-32 mx-auto rounded-full -mt-20 border-8 border-white" src="https://tailwindcomponents.com/storage/avatars/l9ODSfn8w78QkKsrLZw44uFbfm5DKPTJGYhiMgTv.png" alt="">
        <div class="text-center mt-2 text-3xl font-medium"><?php echo $_SESSION['users']?></div>
        <div class="text-center mt-2 font-light text-sm"># <?php echo $_SESSION['role']?></div>
        <div class="text-center font-normal text-lg"><?php echo $_SESSION['department']?></div>

        <hr class="mt-8">
        <div class="flex p-4">
            <div class="w-1/2 text-center">
                <span class=""><?php echo $_SESSION['phone']?></span>
            </div>
            <div class="w-0 border border-gray-300">

            </div>
            <div class="w-1/2 text-center">
                <span class=""><?php echo $_SESSION['email']?></span>
            </div>
        </div>
    </div>
</div>