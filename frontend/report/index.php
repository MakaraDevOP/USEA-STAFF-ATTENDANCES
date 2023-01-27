<?php
    $page_content = "Report";
    $page_title ="Report Center";
    include('../master/header.php');
    include('../master/navbar.php');
    include('../../backend/connection.php');
?>
<main>
    <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
            <div class="">
                <div class="flex justify-between mb-4">
                    <!-- <h1 class="text-2xl font-medium mb-5">Actions</h1> -->
                    <div class=" flex space-x-2">
                        <label for="table-search" class="sr-only">Search</label>
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
                    <div class="flex items-center justify-end rounded-md shadow-sm space-x-3">
                        <button id="btn-add" class="bg-blue-700 hover:bg-blue-600 rounded-lg flex space-x-2 px-3 py-2 text-gray-50 hover:shadow-xl transition duration-150   text-sm ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>Add</span>
                        </button>
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
                                        <th scope="col" class="font-bold text-md py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Code
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Staff
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider text-center text-gray-700 uppercase ">
                                            Role
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-left text-gray-700 uppercase ">
                                            Email
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-left text-gray-700 uppercase ">
                                            Phone
                                        </th>
                                        <th scope="col" class="font-bold text-md py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Status
                                        </th>
                                        <th scope="col" class="p-4">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 " id="datatable">
                                    <!-- Data Table -->
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
            timer: 500,
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
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                        ${data['code']}
                    </td>
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                        ${data['name']}
                    </td>
                        <td class="py-2 px-6 text-sm  text-center font-medium text-gray-900 whitespace-nowrap ">
                <div class=" text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-orange-200 text-orange-700 rounded-full   ${data['role']=="Admin"?'':'hidden' }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity mr-2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                        ${data['role']}
                </div>
                <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full  ${data['role']=="Staff"?'':'hidden' }"">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive mr-2">
                            <line x1="22" y1="12" x2="2" y2="12"></line>
                            <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                            <line x1="6" y1="16" x2="6.01" y2="16"></line>
                            <line x1="10" y1="16" x2="10.01" y2="16"></line>
                        </svg>
                    ${data['role']}
                    </div>
                </td>
                    <td class="py-2 px-6 text-sm  text-left font-medium text-gray-900 whitespace-nowrap ">
                    ${data['email']}
            </td>
            <td class="py-2 px-6 text-sm  text-left font-medium text-gray-900 whitespace-nowrap ">
                ${data['phone']}
            </td>
            <td class="py-2 px-6 text-sm text-center font-medium text-gray-900 whitespace-nowrap ">
                <div class=" hover:underline ${data['status']==1?'text-green-400':'text-gray-400'}">${data['status']==1?'Active':'Inactive'}</div>
            </td>
            <td class="py-2 px-6 text-sm font-medium text-right whitespace-nowrap flex space-x-2 items-center justify-end">
            <a href="/staffAttendence/frontend/user/update?id=${data['id']}" class=" hover:underline text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-1 ">Edit</a>
            <div data-id="${data['id']}" onclick="$.fn.delete(${data['id']})" class="btn-deleted  cursor-pointer text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-1 ">Delete</div>
            </td>
            </tr>
        `
        return Row;
    };

    $.fn.GetList = function() {
        $.fn.startloading();

        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/userHandler.php',
            data: {
                mode: 'list',
            },
            dataType: "json",
            success: function(response) {
                $("#datatable").empty();
                $.fn.stoploading();
                if (response) {
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
                }
            }
        });
    }
    $.fn.GetList();
    $("#btn-search").click(function() {
        var search = $('#table-search').val();
        $.fn.startloading();
        const tSearch = setTimeout(() => {
            if (search != null) {
                if (search.replace(/\s/g, "") !== "") {
                    console.log($(this).val())
                    $.ajax({
                        type: "GET",
                        url: '/staffAttendence/backend/userHandler.php',
                        data: {
                            mode: 'search',
                            search: search
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#datatable").empty();
                                $.fn.stoploading();
                                $.each(response, function(indexes, data) {
                                    $("#datatable").append(
                                        $.fn.RowTable(data)
                                    );
                                });
                                // swal("Successfully ", "Operation was successfully processed ", "success");
                            }
                        }
                    })
                } else {
                    $.fn.GetList();
                    $.fn.stoploading()
                }
            }
        }, 1000);
    });
    $('#btn-add').click(function() {
        document.location = "/staffAttendence/frontend/user/create"
    });
    $('.btn-edit-row').click(function(e) {
        // console.log($(this)[0].nextSibling.nextSibling.value)
        const id = $(this)[0].nextSibling.nextSibling.value;
        e.preventDefault();
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
                swal("Successfully ", "Operation was successfully processed ", "success");

            }
        });
    });
    $.fn.delete = function(id) {
        $.fn.startloading();
        $.ajax({
            type: "POST",
            url: '/staffAttendence/backend/userHandler.php',
            data: {
                mode: "delete",
                id: id
            },
            dataType: "json",
            success: function(response) {
                $.fn.stoploading();
                if (typeof response == 'object' && response.error != null) {
                    swal("Errors ", response.error, "error");
                    return;
                }
                if (response) {
                    swal("Successfully ", "Operation was successfully processed ", "success");
                }
                $.fn.GetList();
            }
        });
    }
});
</script>
<?php
    $page_content = "index";
    include('../master/footer.php');
?>