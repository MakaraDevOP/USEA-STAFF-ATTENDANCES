<?php
    $page_content = "Department";
    $page_title ="Department";
    require_once('../../backend/auth.php');
    include('../master/header.php');
    include('../master/navbar.php');
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
            <div class="">
                <div class="flex justify-between mb-4">
                    <!-- <h1 class="text-2xl  mb-5">Actions</h1> -->
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
                <div class="overflow-x-auto shadow-sm">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed ">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="font-medium py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Code
                                        </th>
                                        <th scope="col" class="font-medium py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Name
                                        </th>
                                        <th scope="col" class="font-medium py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Description
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
            timer: 200,
        });
    }
    var emptyRow = `
        <tr class="hover:bg-gray-100">
            <td colspan="4" class="py-2 px-6 text-sm text-center  text-gray-900 whitespace-nowrap ">
                No record found 👻
            </td>
        </tr>
    `;
    $.fn.RowTable = function(data) {
        var Row = `
            <tr class="hover:bg-gray-100">
                    <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
                        ${data['code_name']}
                    </td>
                    <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
                        ${data['name']}
                    </td>
                    <td class="py-2 px-6 text-sm  text-left  text-gray-900 whitespace-nowrap ">
                    ${data['description']}
            </td>
            <td class="py-2 px-6 text-sm  text-right whitespace-nowrap flex space-x-2 items-center justify-end">
            <a href="/staffAttendence/frontend/department/update?id=${data['id']}" class=" hover:underline text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300  rounded-full text-sm px-5 py-1 ">Edit</a>
            <div data-id="${data['id']}" onclick="$.fn.delete(${data['id']})" class="btn-deleted  cursor-pointer text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-gray-300  rounded-full text-sm px-5 py-1 ">Delete</div>
            </td>
            </tr>
        `
        return Row;
    };

    $.fn.GetList = function() {
        $.fn.startloading();
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/departmentHandler.php',
            data: {
                mode: 'list',
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
                        url: '/staffAttendence/backend/departmentHandler.php',
                        data: {
                            mode: 'search',
                            search: search
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
        document.location = "/staffAttendence/frontend/department/create"
    });
    $('.btn-edit-row').click(function(e) {
        // console.log($(this)[0].nextSibling.nextSibling.value)
        const id = $(this)[0].nextSibling.nextSibling.value;
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/departmentHandler.php',
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
            url: '/staffAttendence/backend/departmentHandler.php',
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