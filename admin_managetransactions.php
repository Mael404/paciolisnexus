<?php
session_start();

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pacioli’S Nexus</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables CSS (only need this once) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables Black and White theme CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bbnw.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .btn-action {
            width: 40px;
            /* Set a fixed width */
            height: 40px;
            /* Set a fixed height */
            display: flex;
            /* Use flexbox to center the icon */
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            padding: 0;
            /* Remove default padding */
            font-size: 18px;
            /* Icon size */
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Pacioli’s Nexus</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" id="notificationIcon">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                     

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                 

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill rounded-circle" style="font-size: 1.5rem;"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            ADMIN
                        </span>
                    </a>
                    <!-- End Profile Icon -->



                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6> <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                            <span>ADMIN</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <?php
    include 'admin_sidebar.php';
    ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Transactions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Manage Transactions</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        
        <section class="section dashboard">
    <div class="row">
        <div class="col-12">
            
               
                <div class="card-body">
                    <table id="materialTable" class="display bbnw table table-bordered text-center align-middle" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Full Name</th>
                                <th>GCash Number</th>
                                <th>GCash Name</th>
                                <th>Proof of Payment</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Ensure table content is centered */
    #materialTable th, #materialTable td,
    #usersTable th, #usersTable td {
        text-align: center;
        vertical-align: middle;
    }

    /* Ensure consistency in modal images */
    #materialTable img {
        max-width: 50px;
        max-height: 50px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
    }
</style>


<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span id="confirmAction"></span> this request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmButton">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Proof of Payment</h5>
               
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Zoomed Image" class="img-fluid" style="border-radius: 5px; max-height: 80vh;">
            </div>
        </div>
    </div>
</div>
     



    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>CodeRedx</span></strong>. All Rights Reserved
        </div>
        <div class="credits">

            Designed by <a href="">CodeRedxPh</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
    $(document).ready(function () {
        var selectedRowId; // Store selected row ID for confirmation

        $('#materialTable').DataTable({
            "ajax": "fetch_materials.php", // URL to fetch data
            "columns": [
                { "data": "full_name" },
                { "data": "gcash_number" },
                { "data": "gcash_name" },
                {
                    "data": "proof_of_payment",
                    "render": function (data) {
                        return `
                            <img src="${data}" alt="Proof of Payment" 
                                 width="50" height="50" 
                                 style="object-fit:cover; border-radius:5px; cursor:pointer;" 
                                 onclick="showImageModal('${data}')">`;
                    }
                },
                { "data": "created_at" },
                { "data": "status" }, // Add the status column here
                {
                    "data": null, // Placeholder for Action column
                    "render": function (data, type, row) {
                        return `
                          <button class="btn btn-success btn-sm" onclick="confirmAction(${row.id}, 'Confirmed')">
    <i class="bi bi-check"></i>
</button>
<button class="btn btn-danger btn-sm" onclick="confirmAction(${row.id}, 'Denied')">
    <i class="bi bi-x"></i>
</button>
`;
                    }
                }
            ],
            "order": [[0, "asc"]]
        });

        // Function to show the image in a modal
        window.showImageModal = function (imageUrl) {
            $('#modalImage').attr('src', imageUrl);
            $('#imageModal').modal('show');
        };

        // Function to show confirmation modal
        window.confirmAction = function (id, action) {
            selectedRowId = id; // Store the ID of the selected row
            const actionText = action === 'confirm' ? 'confirm' : 'deny';
            $('#confirmAction').text(actionText);
            $('#confirmModal').modal('show');

            // When the user confirms the action
            $('#confirmButton').off().on('click', function () {
                updateStatus(selectedRowId, action);
                $('#confirmModal').modal('hide');
            });
        };

        // Function to update the status in the database
        function updateStatus(id, action) {
            $.ajax({
                url: 'material_update.php',
                method: 'POST',
                data: {
                    id: id, 
                    status: action
                },
                success: function (response) {
                    console.log(response); // Log the response
                    if (response.success) {
                        alert("Status updated successfully.");
                        $('#materialTable').DataTable().ajax.reload(); // Reload the table
                    } else {
                        alert("Status updated successfully.");
                        $('#materialTable').DataTable().ajax.reload(); // Reload the table
                    }
                }
            });
        }
    });
</script>


    
</body>

</html>