<?php
    $page_content = "Attendence";
    $page_title ="Attendence Management";
    include('../master/header.php');
    include('../master/navbar.php');
    include('../../backend/connection.php');
?>
<div>
    <div class="mx-auto max-w-7xl py-4 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
            <div class="">
                <div class="flex justify-between mb-4">
                    <!-- <h1 class="text-2xl font-medium mb-5">Actions</h1> -->
                    <div class="flex justify-center items-center space-x-2">
                        <div class=" flex space-x-2">
                            <select name="range" id="range" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-800 focus:border-gray-800 block w-50  p-2  ">
                                <option value="" selected disabled hidden class="text-gray-100">--Select Date Range--</option>
                                <option value="today"> Today</option>
                                <option value="week"> This week</option>
                                <option value="month"> This month</option>
                                <option value="year"> This year</option>
                                <option value="custom"> Custom</option>
                            </select>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="date" id="from-date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " format="dd-mm-yyyy">
                            </div>
                        </div>
                        <div>
                            <span class="">To</span>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="date" id="to-date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " placeholder="Search for items">
                            </div>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " placeholder="Search for items">
                            </div>
                            <div class=" flex items-center justify-end ">
                                <button id="btn-search" class="bg-gray-800 hover:bg-gray-700 rounded-lg px-1   py-2 text-gray-50 hover:shadow-xl transition duration-150   text-lg ">
                                    <svg class="w-8 h-5 text-gray-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end rounded-md shadow-sm space-x-3">
                        <!-- <button id="btn-add" class="bg-blue-700 hover:bg-blue-600 rounded-lg flex space-x-2 px-3 py-2 text-gray-50 hover:shadow-xl transition duration-150   text-sm ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>Add</span>
                        </button> -->
                        <button id="btn-delete" class="bg-gray-800 hover:bg-gray-700 rounded-lg flex space-x-2 px-3 py-2 text-gray-50 hover:shadow-xl transition duration-150   text-sm ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>Delete</span>
                        </button>
                    </div>
                    <!-- <hr class="mt-5 border border-slate-100"> -->
                </div>
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
</div>
<script type="text/javascript">
$(document).ready(function() {
    const Format = (today) => {
        let date = new Date(today);
        //use method getDate() , getMonth, getFullYear 
        let dd = date.getDate().toString();
        let mm = (date.getMonth() + 1).toString();
        let yyyy = date.getFullYear();
        //we will insert 0 and month if the month is less than 10 (mean length <2)
        if (mm.length < 2) {
            mm = '0' + mm;
        }
        if (dd.length < 2) {
            dd = '0' + dd;
        }
        return [mm, dd, yyyy].join('/');
    }
    $('#range').change(function() {
        const today = new Date();

        $('#from-date').val(Format(today));
        console.log($('#from-date').val())
    })
    $("#from-date").datepicker();
});
</script>
<?php
    include('../master/footer.php');
?>