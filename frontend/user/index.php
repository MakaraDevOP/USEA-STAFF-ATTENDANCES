<?php
    $page_content = "Staff";
    $page_title ="Staff Management";
    require_once('../../backend/auth.php');
    require_once('../../backend/connection.php');
    include('../master/header.php');
    include('../master/navbar.php');
?>
<main>
    <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
            <div class="">
                <div class="flex justify-between mb-4">
                    <!-- <h1 class="text-2xl mb-5">Actions</h1> -->
                    <div class=" flex space-x-2">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " placeholder="Search for items">
                        </div>
                        <div class=" flex items-center justify-end ">
                            <button id="btn-search" class="bg-gray-800 hover:bg-gray-700 rounded-lg px-3   py-2 text-gray-50 hover:shadow-xl transition duration-150   text-lg ">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-end rounded-md shadow-sm space-x-3">
                        <button id="btn-add" class="bg-blue-700 hover:bg-blue-600 rounded-lg flex space-x-2 px-3 py-2 items-center justify-center text-gray-50 hover:shadow-xl transition duration-150   text-sm ">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add</span>
                        </button>
                        <button id="btn-delete" class="bg-gray-800 hover:bg-gray-700 rounded-lg flex space-x-2 px-3 py-2  items-center justify-center text-gray-50 hover:shadow-xl transition duration-150   text-sm ">
                            <i class="fa-solid fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                    <!-- <hr class="mt-5 border border-slate-100"> -->
                </div>
                <div class="overflow-x-auto  shadow-sm h-[calc(100vh-250px)]">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y-2 divide-gray-200 table-fixed ">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="font-medium  py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Code
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Staff
                                        </th>
                                        <th scope="col" class="font-medium py-3 px-6  tracking-wider text-center text-gray-700 uppercase ">
                                            Role
                                        </th>
                                        <th scope="col" class="font-medium py-3 px-6  tracking-wider  text-left text-gray-700 uppercase ">
                                            Email
                                        </th>
                                        <th scope="col" class="font-medium py-3 px-6  tracking-wider  text-left text-gray-700 uppercase ">
                                            Phone
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-left text-gray-700 uppercase ">
                                            Department
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Status
                                        </th>
                                        <th scope="col" class="p-4">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y-2 divide-gray-200 " id="datatable">
                                    <!-- Data Table -->
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="inline-flex -space-x-px py-1 " id="pagination">

                    </ul>
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
            timer: 200,
        });
    }
    var emptyRow = `
        <tr class="hover:bg-gray-100">
            <td colspan="8" class="py-2 px-6 text-sm text-center text-gray-900 whitespace-nowrap ">
                No record found 👻
            </td>
        </tr>
    `;
    $.fn.RowTable = function(data) {
        var Row = `
            <tr class="hover:bg-gray-100 border-y-2">
                    <td class="py-2 px-6 text-sm text-gray-900 whitespace-nowrap ">
                        ${data['code']}
                    </td>
                    <td class="py-2 px-6 text-sm text-gray-900 whitespace-nowrap ">
                        ${data['name']}
                    </td>
                        <td class="py-2 px-6 text-sm  text-center text-gray-900 whitespace-nowrap ">
                <div class=" text-xs inline-flex items-center font-semibold leading-sm uppercase px-3 py-1 bg-orange-200 text-orange-700 rounded-full   ${data['role']=="Admin"?'':'hidden' }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity mr-2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                        ${data['role']}
                </div>
                <div class="text-xs inline-flex items-center font-semibold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full  ${data['role']=="Staff"?'':'hidden' }"">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive mr-2">
                            <line x1="22" y1="12" x2="2" y2="12"></line>
                            <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                            <line x1="6" y1="16" x2="6.01" y2="16"></line>
                            <line x1="10" y1="16" x2="10.01" y2="16"></line>
                        </svg>
                    ${data['role']}
                    </div>
                </td>
                    <td class="py-2 px-6 text-sm  text-left text-gray-900 whitespace-nowrap ">
                    ${data['email']}
            </td>
            <td class="py-2 px-6 text-sm  text-left text-gray-900 whitespace-nowrap ">
                ${data['phone']}
            </td>
            <td class="py-2 px-6 text-sm  text-left text-gray-900 whitespace-nowrap ">
                ${data['depart_name']!=null?data['depart_name']:""}
            </td>
            <td class="py-2 px-6 text-sm text-center text-gray-900 whitespace-nowrap ">
                <div class=" hover:underline ${data['status']==1?'text-green-400':'text-gray-400'}">${data['status']==1?'Active':'Inactive'}</div>
            </td>
            <td class="py-2 px-6 text-sm text-right whitespace-nowrap flex space-x-2 items-center justify-end">
            <a href="/staffAttendence/frontend/user/update?id=${data['id']}" class=" hover:underline text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-1 ">Edit</a>
            <div data-id="${data['id']}" onclick="$.fn.delete(${data['id']})" class="btn-deleted  cursor-pointer text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-1 ">Delete</div>
            </td>
            </tr>
        `
        return Row;
    };

    $.fn.Pagination = function(data) {
        let link = "";
        if (data != null) {

            for (var i = 1; i <= data.page; i++) {
                if (i == data.page_number) {
                    link += `<li>
                        <button type="button"   onclick="$.fn.linkPage(${Number(i)})" data-page="${Number(i)}" class="link-btnn-page bg-blue-100 border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 ">${i}</button>
                </li>`;
                } else {
                    link += `
                 <li>
                        <button type="button" onclick="$.fn.linkPage(${Number(i)})" data-page="${Number(i)}" class="link-btnn-page bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 ">${i}</button>
                </li>`;
                }

            }
        }

        const prewpage = `
     <li>
            <button type="button" ${data.page_number ==1?'disabled':''}  onclick="$.fn.linkPage(${Number(data.page_number)-1})" data-page="${Number(data.page_number)-1}"  class="link-btnn-page  ${data.page_number==1?'bg-gray-200 text-gray-400':'bg-white hover:bg-gray-100 hover:text-gray-700'}   border border-gray-300 text-gray-500  rounded-l-lg leading-tight py-2 px-3 ">Previous</button>
    </li>`;

        const nextpage = `
    <li >
        <button ${data.page_number ==data.page?'disabled':''} onclick="$.fn.linkPage(${Number(data.page_number)+1})" type="button" data-page="${Number(data.page_number)+1}" class="link-btnn-page ${data.page_number==data.page?'bg-gray-200 text-gray-400':'bg-white hover:bg-gray-100 hover:text-gray-700'}   border border-gray-300 text-gray-500  rounded-r-lg leading-tight py-2 px-3 ">Next</button >
    </li>
     `;
        const page = prewpage + link + nextpage;
        return page;
    }
    let pagenum = 1;
    let per_page = 15;
    $.fn.GetList = function(pagenum) {
        $.fn.startloading();
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/userHandler.php',
            data: {
                mode: 'list',
                per_page: per_page,
                page_number: pagenum
            },
            dataType: "json",
            success: function(response) {
                $("#datatable").empty();
                $.fn.stoploading();
                if (response.data.length < 0) {
                    $("#datatable").append(
                        emptyRow
                    );
                    return;
                }
                if (response.data) {

                    $.each(response.data, function(indexes, data) {
                        $("#datatable").append(
                            $.fn.RowTable(data)
                        );
                    });
                    $('#pagination').empty();
                    $('#pagination').append(
                        $.fn.Pagination(response.paginate)
                    )
                }
            }
        });
    }
    $.fn.GetList(pagenum);

    $.fn.linkPage = function(e) {
        pagenum = e;
        $.fn.GetList(e);

    }
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
                            search: search,
                            per_page: per_page,
                            page_number: pagenum
                        },
                        dataType: "json",
                        success: function(response) {
                            $("#datatable").empty();
                            $.fn.stoploading();
                            if (response.data.length < 0) {
                                $("#datatable").append(
                                    emptyRow
                                );
                                return;
                            }
                            if (response.data) {

                                $.each(response.data, function(indexes, data) {
                                    $("#datatable").append(
                                        $.fn.RowTable(data)
                                    );
                                });
                                $('#pagination').empty();
                                $('#pagination').append(
                                    $.fn.Pagination(response.paginate)
                                )
                            }
                        }
                    })
                } else {
                    $.fn.GetList(pagenum);
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
                $.fn.GetList(pagenum);
            }
        });
    }
});
</script>
<?php
    $page_content = "index";
    include('../master/footer.php');
?>