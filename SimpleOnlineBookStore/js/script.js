$(document).ready(function () {
    // Function to load data
    function loadTable() {
        $.ajax({
            url: "php/main.php",
            type: "POST",
            data: { method: "loadTable" }, // Pass method name
            success: function (data) {
                $("#table-data").html(data);
                // console.log(data);
            }
        });
    }

    loadTable(); // Initial load

    // We can load data of author and category in add table data 
    // to add new category and author we can add button on the form

    // Add  New Book to Database
    $("#addbook").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);
        formData.append('method', 'insertBook');
        console.log("Requesting:", "../php/main.php"); // This should print
        if (formData.get('method') === '') {
            console.log('status = false, message = Method is empty');
        } else {
            console.log('status = true, method =', formData.get('method')); // Log the method value        
            $.ajax({
                url: "php/main.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    response = JSON.parse(data);
                    if (response.status == 'success') {
                        $("#success-message").html(response.message).slideDown();
                        $("#error-message").slideUp();
                        $('#addbook')[0].reset();
                        loadTable();
                    } else {
                        $("#error-message").html(response.message).slideDown();
                        $("#success-message").slideUp();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error adding book:', error);
                    alert('Error adding book. Please try again.');
                }
            });
        }
    });

    // Delete Book from Database
    $(document).on("click", ".delete-btn", function () {
        if (confirm("Do you really want to delete this record?")) {
            var id = $(this).data("id");
            var element = this;

            $.ajax({
                url: "php/main.php",
                type: "POST",
                data: { id: id, method: "deleteBook" },
                success: function (data) {
                    response = JSON.parse(data); // Parse JSON response
                    if (response.status == 'success') {
                        $(element).closest("tr").fadeOut();
                        $("#error-message").slideUp();
                        setTimeout(function () {
                            $("#success-message").html("Book Record Deleted Successfully.").slideDown();
                        }, 4000);
                        loadTable();
                    } else {
                        $("#success-message").slideUp();
                        setTimeout(function () {
                            $("#error-message").html(response.message).slideDown();
                            $("#error-message").slideUp();
                        }, 4000);
                    }
                }
            });
        }
    });

    // Update The form Data 

    // show modal Box
    $(document).on("click", ".edit-btn", function () {
        var id = $(this).data("eid"); // Get the book ID from the button's data attribute
        $("#editModal").show(); // Show the modal

        $.ajax({
            url: "php/main.php",
            type: "POST",
            data: { id: id, method: "loadBookData" },
            success: function (data) {
                console.log("Received data:", data);
                $("#editForm").html(data);
                $("#editModal").show();
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
            }
        });
    });

    // Hide Modal Box
    $("#close-btn").on("click", function () {
        $("#editModal").hide();
        console.log("Close button pressed")
    });
    // update form data of the book 
    $("#edit-submit").on("click", function (e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);
        formData.append('method', 'updateBook');

        if (formData.get('method') === '') {
            console.log('status = false, message = Method is empty');
        } else {
            console.log('status = true, method =', formData.get('method')); // Log the method value        
            $.ajax({
                url: "php/main.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    response = JSON.parse(data);
                    if (response.status == 'success') {
                        $("#success-message").html(response.message).slideDown();
                        $("#error-message").slideUp();
                        loadTable();
                    } else {
                        $("#error-message").html(response.message).slideDown();
                        $("#success-message").slideUp();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error adding book:', error);
                    alert('Error adding book. Please try again.');
                }
            });
        }
    });

});
