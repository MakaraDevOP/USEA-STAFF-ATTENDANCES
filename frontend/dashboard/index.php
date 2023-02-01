<?php
    // session_start();
    $page_content = "Home";
    $page_title ="Dashboard";
    require_once('../../backend/auth.php');
    require_once('../../backend/connection.php');
    include('../master/header.php');
    include('../master/navbar.php');
?>
<?php
// TESTING SET DATA SESSION  LIKE LOGIN SYSTEM
    // $_SESSION['userid'] =12;
    // $_SESSION['users'] = "Vanak";
    // $_SESSION['role'] = "Staff";
    $userId = $_SESSION['userid'];
// TESTING SET DATA SESSION  LIKE LOGIN SYSTEM

    //   សម្រាប់ Admin
    if($_SESSION['role'] == "Admin"){
        $db = new Database();
        $sql = "SELECT COUNT(*) as 'total' FROM  users ORDER BY name;";
        $result = $db->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $totalUser = $row['total'];
    
        $sql1= "SELECT COUNT(*) as 'clockin' FROM  attendances WHERE  date_clock_out IS NULL AND DATE(date)=CURDATE();";
        $result1 = $db->mysqli->query($sql1);
        $row1 = $result1->fetch_assoc();
        $totalClockin = $row1['clockin'];

        $sql2 ="SELECT location, COUNT(*) AS 'top' FROM attendances GROUP BY location ORDER BY top DESC LIMIT 1";
        $result2 = $db->mysqli->query($sql2);
        $row2 = $result2->fetch_assoc();
        $toplocation = $row2['location'];
        $top = $row2['top'];


    }
    //   សម្រាប់ Staff
    if( $_SESSION['role'] == "Staff"){
        $db = new Database();
        // ទាញយកទិន្នន័យ បុគ្គលិក បាន ចូលធ្វើការហើយ ឬនៅសម្រាប់ ថ្ងៃនេះ
        $sql = "SELECT * FROM  view_attendances_list WHERE  user_id=$userId  AND  NOT (date_clock_in <=> NULL)  AND date_clock_out IS NULL LIMIT 1";
        $result = $db->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $ClockinUser = $row;
        // ពិនិត្យថា បុគ្គលិក បាន ចូលធ្វើការហើយ ឬនៅសម្រាប់ ថ្ងៃនេះ
        $sql1= "SELECT *   FROM  view_attendances_list WHERE  user_id=$userId  AND DATE(date)=CURDATE();";
        $result1 = $db->mysqli->query($sql1);
        $row1 = $result1->fetch_assoc();
        $dataClockin = $row1;
        $haveClockIn = false;
        if($row1>0&&$ClockinUser<=0){
             $haveClockIn = true;
        }
        //  កំណត់ Status នៅពេល បុគ្កលិកចូល និង​ចេញ
        if($ClockinUser>0){
            $_SESSION['status'] = "Clock In";
        }else{
            $_SESSION['status'] = "Clock Out";
        }
    }

?>
<main>
    <!-- Start Admin -->
    <?php if($_SESSION['role'] == "Admin"){?>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div>
            <div class=" flex  gap-4 items-center justify-center bg-white">
                <a href="#" class="w-[20rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <div class="grid grid-cols-6 p-5 gap-y-2">

                        <div class="col-span-5 md:col-span-4 ml-4">
                            <p class="text-gray-600 text-2xl font-bold font-kh ">សរុបបុគ្គលិក</p>
                            <p class="text-gray-400 font-kh">បុគ្គលិនទាំងអស់</p>
                        </div>

                        <div class="flex col-start-2 ml-4 md:col-start-auto md:ml-0 md:justify-end">
                            <p class="rounded-lg text-sky-500 font-bold bg-sky-100  py-1 px-3 text-sm w-fit h-fit text-3xl"> <?php echo $totalUser?> </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="w-[2៥rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <div class="grid grid-cols-6 p-5 gap-y-2 w-full">
                        <div class="col-span-5 md:col-span-4 ml-4">
                            <p class="text-gray-600 text-2xl font-bold font-kh">សរុបបុគ្គលិកកំពុងធ្វើការ</p>
                            <p class="text-gray-400 font-kh">ចូលធ្វើការថ្ងែនេះ</p>
                        </div>
                        <div class="flex col-start-2 ml-4 md:col-start-auto md:ml-0 md:justify-end">
                            <p class="rounded-lg text-green-500 font-bold bg-green-100  py-1 px-3 text-sm w-fit h-fit text-3xl"> <?php echo $totalClockin?> </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="w-[20rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <div class="grid grid-cols-6 p-4 ">
                        <!-- Profile Picture -->
                        <!-- Description -->
                        <div class="col-span-4 ">
                            <p class="text-gray-600  font-bold font-kh ">ទីតាំងច្រើនបំផុត</p>
                            <p class="text-gray-400 font-kh text-sm"><?php  echo $toplocation?><span class="px-2 mx-2 rounded bg-blue-400 text-white mt-[-10px]"><?php  echo $top?></span></p>
                        </div>
                        <!-- Price -->
                        <div>
                            <div class="flex items-end justify-end">
                                <p class="rounded-lg text-orange-500 font-bold bg-orange-100  py-1 px-3 text-sm  text-3xl"> HQ </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <div class="">
                <div class="overflow-x-auto shadow">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y-2 divide-gray-200 table-fixed ">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <!-- <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th> -->
                                        <th scope="col" class="font-medium  py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Employee Name
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Date
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-In
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-Out
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Work Time
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y-2 divide-gray-200 " id="datatable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /End replace -->
    </div>
    <?php }?>
    <!-- End Admin -->
    <!-- Start Staff -->
    <?php if($_SESSION['role'] == "Staff"){?>
    <div class="h-[calc(100vh-100px)]  bg-gray-100 py-5">
        <h1 class="mt-10 mb-1 text-center text-3xl font-bold font-kh text-gray-800">ម៉ោងចូលធ្វើការ</h1>
        <h1 class="mb-10 text-center text-xl   text-gray-600">Clock In</h1>
        <form id="submitForm">
            <input type="hidden" name="mode" value="<?php  echo $_SESSION['status']=="Clock In" ?"clockout":"clockin" ?>">
            <input type="hidden" name="txn_id" value="<?php  echo $_SESSION['status']=="Clock In" ?$ClockinUser['id']:"" ?>">

            <div class="mx-auto max-w-7xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="rounded-lg md:w-2/3">

                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow sm:flex flex-col sm:justify-start">
                        <!-- Alert message -->
                        <?php if($haveClockIn==true) {?>
                        <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 ">
                            <div slot="avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle w-5 h-5 mx-2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <div class="text-md font-normal  max-w-full flex-initial font-kh py-2">
                                អ្នកបាន ចូលធ្វើការថ្ងែនេះហើយ រយះពេល <?php echo $dataClockin['work_time']?> ម៉ោង!
                                ជួបគ្នាថ្ងៃស្អែក 👋
                            </div>
                            <div class="flex flex-auto flex-row-reverse">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x cursor-pointer hover:text-green-400 rounded-full w-5 h-5 ml-2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <!-- Alert message -->

                        <div class=" mt-2 sm:ml-4 sm:flex sm:w-full sm:justify-between space-x-5 ">
                            <div class="mt-5 sm:mt-0">
                                <h1 class="font-bold text-xl text-gray-600">Staff Information</h1>
                                <div class="flex flex-col mt-2">
                                    <label for="location" class="text-gray-700 text-sm">Staff name</label>
                                    <input type="hidden" name="user" value="<?php echo $_SESSION['userid'];?>">
                                    <input type="text" value="<?php echo $_SESSION['users'];?>" readonly class="mt-2 bg-gray-100 border border-gray-300 text-gray-600 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-[400px] p-2  " placeholder="Enter " required>
                                </div>
                                <div class="flex flex-col mt-2">
                                    <label for="location" class="text-gray-700 text-sm">Location</label>
                                    <input type="text" id="location" name="location" value="<?php  echo $_SESSION['status']=="Clock In" ?$ClockinUser['location']:"" ?>" class="mt-2  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-[400px]  p-2  " placeholder="Enter your location" required>
                                </div>
                                <div class="flex flex-col mt-2">
                                    <label for="note" class="text-gray-700 text-sm">Note</label>
                                    <textarea name="note" id="note" rows="4" cols="56" class="mt-2 p-2 border border-gray-300 focus:ring-blue-500 focus:border-gray-500 rounded text-sm text-gray-900" placeholder="Enter your note"><?php  echo $_SESSION['status']=="Clock In" ?$ClockinUser['note']:"" ;?></textarea>
                                </div>
                            </div>
                            <div class=" px-5 w-full ">
                                <h1 class="font-bold text-xl text-gray-600">Automatically</h1>
                                <div class="flex flex-col mt-2">
                                    <label for="location" class="text-gray-700 text-sm">Date</label>
                                    <input type="hidden" name="date" id="date">
                                    <input type="date" id="clockin-date" readonly class="mt-2 bg-gray-100  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full  p-2 ">
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sub total -->
                <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow md:mt-0 md:w-1/3">
                    <div class="mb-2 flex justify-between">
                        <p class="text-gray-700 upercase font-bold">Day Total </p>
                        <p class="text-gray-700 upercase font-bold">Status</p>
                    </div>
                    <div class="flex justify-between">
                        <input type="hidden" name="work_time" id="wkTime" value="">
                        <p class="text-green-600 font-bold text-lg  <?php  echo $_SESSION['status']=="Clock In" ? "daytotal":"" ?>">
                            <?php  echo $_SESSION['status']=="Clock In" ? $ClockinUser['work_time']:"--:--" ?>
                        </p>
                        <p class=" font-bold text-lg <?php  echo $_SESSION['status']=="Clock In" ? "text-green-600":"text-gray-500" ?>"><?php echo $_SESSION['status'] ?> </p>
                    </div>
                    <hr class="my-4" />
                    <div class="flex justify-between">
                        <p class="text-sm ">Location :</p>
                        <p class="mb-1 text-sm "><?php  echo $_SESSION['status']=="Clock In" ? $ClockinUser['location']:"" ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm ">Note :</p>
                        <p class="mb-1 text-sm "><?php  echo $_SESSION['status']=="Clock In" ? $ClockinUser['note']:"" ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm ">Device :</p>
                        <p class="mb-1 text-sm text-gray-400"><?php  echo $_SESSION['status']=="Clock In" ? $ClockinUser['device_name']:"" ?></p>
                    </div>
                    <button class="mt-6 w-full rounded-md  py-1.5 font-medium text-blue-50 bg-blue-500 hover:bg-blue-600  <?php  echo $haveClockIn==true ? 'opacity-40':'' ?>
                    <?php echo $_SESSION['status']!="Clock In"?"bg-blue-500 hover:bg-blue-600":"bg-red-500 hover:bg-red-600"?> " id="clockIn-btn" type="submit" <?php  echo $haveClockIn==true ? 'disabled':'' ?>>
                        <?php echo $_SESSION['status']!="Clock In"?"Clock In":"Clock Out"?>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php }?>
    <!-- End Staff -->
</main>
<script>
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
var emptyRow = `
        <tr class="hover:bg-gray-100">
            <td colspan="8" class="py-2 px-6 text-sm text-center  text-gray-900 whitespace-nowrap ">
                No record found 👻
            </td>
        </tr>
    `;
$.fn.RowTable = function(data) {
    var Row = `
           <tr class="hover:bg-gray-100">
            <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
             ${data['name']}
            </td>
            <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
              ${data['date']!=null?data['date']:""}
            </td>
            <td class="py-2 px-6 text-sm  text-center  text-gray-900 whitespace-nowrap ">
                ${data['date_clock_in']!=null?data['date_clock_in']:""}
            </td>
            <td class="py-2 px-6 text-sm   text-center  text-gray-900 whitespace-nowrap ">
                ${data['date_clock_out']!=null?data['date_clock_out']:"-- : --"}
            </td>
            <td class="py-2 px-6 text-sm text-center  text-gray-900 whitespace-nowrap ">
                <span class="text-green-600 ${data['date_clock_out']!=null?' ':'wk-time'}" >${data['work_time']!=null? data['work_time'] :""} </span > <span class="text-green-600">h</span>
            </td>
        </tr>
        `
    return Row;
};
var user_role = "<?php echo$_SESSION['role']; ?>";

if (user_role == "Admin") {
    $.fn.setTimerLoading = setInterval(function(e) {
        let wk = $('.wk-time');
        $.each(wk, function(indexes, data) {
            let datatime = $(data).text()
            if (datatime != null && datatime != undefined) {
                let time = datatime.split(":");
                let h = parseInt(time[0]);
                let m = parseInt(time[1]);
                let s = parseInt(time[2]);
                s++;
                if (s == 60) {
                    m++;
                    s = 00;
                }
                if (m == 60) {
                    h++;
                    m = 00;
                }
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);
                let returnDate = h + ':' + m + ':' + s;
                $(data).text(returnDate);
            }
        });
    }, 1000);
    $.fn.GetList = function() {
        $.fn.startloading();
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/attendanceHandler.php',
            data: {
                mode: 'list-today',
            },
            dataType: "json",
            success: function(response) {
                $("#datatable").empty();
                $.fn.stoploading();
                if (response.data != undefined) {
                    $("#datatable").append(
                        emptyRow
                    );
                    return;
                }
                if (response) {
                    $.each(response, function(indexes, data) {
                        $("#datatable").append(
                            $.fn.RowTable(data)
                        );
                    });
                    // Loading Time Working 
                }
            }
        });
    }
    $.fn.GetList();
}

$.fn.setDate = function() {
    $('#clockin-date').val(moment(new Date()).format("YYYY-MM-DD"))
    var date = moment(new Date()).format("YYYY-MM-DD HH:mm:ss")
    $('#date').val(date);
}
if (user_role == "Staff") {
    $.fn.setTimerLoading = setInterval(function(e) {
        let wk = $('.daytotal');
        $.each(wk, function(indexes, data) {
            let datatime = $(data).text()
            if (datatime != null && datatime != undefined) {
                let time = datatime.split(":");
                let h = parseInt(time[0]);
                let m = parseInt(time[1]);
                let s = parseInt(time[2]);
                s++;
                if (s == 60) {
                    m++;
                    s = 00;
                }
                if (m == 60) {
                    h++;
                    m = 00;
                }
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);
                let returnDate = h + ':' + m + ':' + s;
                $(data).text(returnDate);
                $('#wkTime').val(returnDate);
            }
        });
    }, 1000);

    $.fn.setDate();

    $('#submitForm').submit(function(e) {
        $.fn.setDate();
        $.fn.startloading();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/staffAttendence/backend/attendanceHandler.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                $.fn.stoploading();
                if (typeof response == 'object' && response.error != null) {
                    swal("Errors ", response.error, "error");
                    return;
                }
                if (response) {
                    swal("Successfully ", "Operation was successfully processed ", "success");
                    $('#submitForm')[0].reset();
                    window.setTimeout('location.reload()', 3000);
                }
            }
        });

    })

}
</script>
<?php
    $page_content = "index";
    include('../master/footer.php');
?>