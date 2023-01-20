<?php
    $page_content = "Home";
    $page_title ="Dashboard";

    include('master/header.php');
    include('master/navbar.php');
    include('../backend/connection.php');

?>
<?php
    $db = new Database();
    $sql = "SELECT COUNT(*) as 'total' FROM  users ORDER BY name;";
    $result = $db->mysqli->query($sql);
    $row = $result->fetch_assoc();
    $totalUser = $row['total'];
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div>
            <div class=" flex  gap-4 items-center justify-center bg-white">
                <!-- Card 1 -->
                <a href="#" class="w-[20rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <!-- Badge -->
                    <!-- <p class="bg-sky-500 w-fit px-4 py-1 text-sm font-bold text-white rounded-tl-lg rounded-br-xl"> FEATURED </p> -->
                    <div class="grid grid-cols-6 p-5 gap-y-2">
                        <!-- Profile Picture -->
                        <!-- Description -->
                        <div class="col-span-5 md:col-span-4 ml-4">
                            <p class="text-gray-600 text-2xl font-bold">Total Staff </p>

                            <p class="text-gray-400">Staff have been count </p>
                        </div>
                        <!-- Price -->
                        <div class="flex col-start-2 ml-4 md:col-start-auto md:ml-0 md:justify-end">
                            <p class="rounded-lg text-sky-500 font-bold bg-sky-100  py-1 px-3 text-sm w-fit h-fit text-3xl"> <?php echo $totalUser?> </p>
                        </div>
                    </div>
                </a>
                <!-- Card 2 -->
                <a href="#" class="w-[20rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <div class="grid grid-cols-6 p-5 gap-y-2 w-full">
                        <!-- Profile Picture -->

                        <!-- Description -->
                        <div class="col-span-5 md:col-span-4 ml-4">
                            <p class="text-gray-600 text-2xl font-bold">Total Clock-In</p>

                            <p class="text-gray-400">Staff have been clock</p>

                        </div>
                        <!-- Price -->
                        <div class="flex col-start-2 ml-4 md:col-start-auto md:ml-0 md:justify-end">
                            <p class="rounded-lg text-green-500 font-bold bg-green-100  py-1 px-3 text-sm w-fit h-fit text-3xl"> 4 </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="w-[20rem] border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50">
                    <div class="grid grid-cols-6 p-4 ">
                        <!-- Profile Picture -->

                        <!-- Description -->
                        <div class="col-span-4 ">
                            <p class="text-gray-600 font-bold"> Top Location </p>
                            <p class="text-gray-400"> Banteay Mean Chey , Cambodia</p>
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
                <div class="overflow-x-auto shadow-sm">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed ">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <!-- <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th> -->
                                        <th scope="col" class="font-bold text-md py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Employee Name
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Date
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-In
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-Out
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Work Time
                                        </th>
                                        <!-- <th scope="col" class="p-4">
                                            <span class="sr-only">Edit</span>
                                        </th> -->
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200 ">
                                    <tr class="hover:bg-gray-100">
                                        <!-- <td class="p-4 w-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td> -->
                                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.email }} -->
                                            Makara
                                        </td>
                                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.firstname }} -->
                                            17/01/2023
                                        </td>
                                        <td class="py-2 px-6 text-sm  text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            8:01 AM
                                        </td>
                                        <td class="py-2 px-6 text-sm   text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            - -
                                        </td>
                                        <td class="py-2 px-6 text-sm text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            <div class="text-green-600"> 6:59 h</div>
                                        </td>
                                        <!-- <td class="py-2 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="#" class="hover:underline text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-1 ">Edit</a>
                                        </td> -->
                                    </tr>
                                    <tr class="hover:bg-gray-100">
                                        <!-- <td class="p-4 w-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td> -->
                                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.email }} -->
                                            Vanthorng
                                        </td>
                                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.firstname }} -->
                                            17/01/2023
                                        </td>
                                        <td class="py-2 px-6 text-sm  text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            8:01 AM
                                        </td>
                                        <td class="py-2 px-6 text-sm   text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            - -
                                        </td>
                                        <td class="py-2 px-6 text-sm text-center font-medium text-gray-900 whitespace-nowrap ">
                                            <!-- {{ data.lastname }} -->
                                            <div class="text-green-600"> 6:59 h</div>
                                        </td>
                                        <!-- <td class="py-2 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="#" class="hover:underline text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-1 ">Edit</a>
                                        </td> -->
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</main>
<?php
    $page_content = "index";
    include('master/footer.php');
?>