@section('scripts')
<script>
    var dormcarts = {!! json_encode($dormcarts) !!};

    function openModal() {
        // Check if any checkbox is selected
        const checkboxes = document.querySelectorAll('.reservation-checkbox');
        let isAnyCheckboxSelected = false;
        let selectedCount = 0;
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedCount++;
            }
        }


        // Get selected dorm cart IDs
        const dormCartIds = [];
        document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
            dormCartIds.push(checkbox.value);
        });

        let isReservorCOAOut = true;

        // Loop through dormcarts data
        for (let i = 0; i < dormcarts.length; i++) {
            const dormcart = dormcarts[i];
            if (dormCartIds.includes(dormcart.id.toString())) {
                // Check if the occupant_type is 'COA'
                if (dormcart.occupant_type === 'Non COAn') {
                    isReservorCOAOut = false;
                    break;
                }
            }
        }

        if (isReservorCOAOut == false) {
            // Select the element with id dormFormNonCoanInfo
            const dormFormNonCoanInfo = document.getElementById('dormFormNonCoanInfo');

            // Change its display property to "block"
            dormFormNonCoanInfo.style.display = "block";

        } else {

            const COARow1 = document.getElementById('COARow1');
            const COARow2 = document.getElementById('COARow2');
            const title_referred = document.getElementById('title_referred');
            const line_break = document.getElementById('line_break');


            // Change its display property to "none"
            COARow1.style.display = "none";
            COARow2.style.display = "none";
            title_referred.style.display = "none";
            line_break.style.display = "none";

        }


        //Trial end

        if (selectedCount > 0) {
            const gymCardVisible = window.getComputedStyle(document.getElementById('gymReservationsCartCard')).display !== 'none';
            const dormCardVisible = window.getComputedStyle(document.getElementById('dormReservationsCartCard')).display !== 'none';
            if (gymCardVisible && selectedCount <= 3) {
                $('#cartToFormModalGym').modal('show');
            } else if(dormCardVisible) {
                $('#cartToFormModalDorm').modal('show');
            }else{
                Swal.fire("The maximum number of items to be put into a form is only 3.", "", "warning");
            }

        } else {
            Swal.fire("Please select items to place into form", "", "warning");
        }

    }

    // Declare variable to store DataTable instance
    let dormTable;

    // Function to initialize DataTable for dorm reservations
    function initializeDormTable() {
        if (!dormTable) {
            dormTable = $('#dormCartReservationsTable').DataTable({
                "paging": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 15, 20],
                "columnDefs": [{
                    "targets": "_all",
                    "className": "dt-head-left"
                }],
            });
        }
    }

    // Function to destroy DataTable for dorm reservations
    function destroyDormTable() {
        if (dormTable) {
            dormTable.destroy();
            dormTable = null; // Reset dormTable variable
        }
    }


    function confirmation() {
        Swal.fire({
            title: "Are you sure you want to checkout all the selected items?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // // Check if gym reservations card is visible
                // const gymCardVisible = document.getElementById('gymReservationsCartCard').style.display !==
                //     'none';
                // // Check if dorm reservations card is visible
                // const dormCardVisible = document.getElementById('dormReservationsCartCard').style.display !==
                //     'none';
                // Prevent default form submission
                const gymCardVisible = window.getComputedStyle(document.getElementById(
                    'gymReservationsCartCard')).display !== 'none';
                const dormCardVisible = window.getComputedStyle(document.getElementById(
                    'dormReservationsCartCard')).display !== 'none';


                if (gymCardVisible) {
                    const companyName = document.getElementById('companyName').value;
                    const address = document.getElementById('address').value;
                    const nameRepresentative = document.getElementById('nameRepresentative').value;
                    const contactNumber = document.getElementById('contactNumber').value;


                    // Check if any field is empty
                    if (!companyName || !address || !nameRepresentative || !contactNumber) {
                        document.getElementById('companyName').placeholder = (!companyName) ?
                            "Please fill in Company Name" : "";
                        document.getElementById('address').placeholder = (!address) ? "Please fill in Address" :
                            "";
                        document.getElementById('nameRepresentative').placeholder = (!nameRepresentative) ?
                            "Please fill in Name Representative" : "";
                        document.getElementById('contactNumber').placeholder = (!contactNumber) ?
                            "Please fill in Contact Number" : "";
                        return; // Prevent form submission
                    }

                    // Set values of hidden input fields in the form
                    document.getElementById('hidden_companyName').value = companyName;
                    document.getElementById('hidden_address').value = address;
                    document.getElementById('hidden_nameRepresentative').value = nameRepresentative;
                    document.getElementById('hidden_contactNumber').value = contactNumber;

                    // Get selected gym cart IDs
                    const gymCartIds = [];
                    document.querySelectorAll('.gym-cart-checkbox:checked').forEach((checkbox) => {
                        gymCartIds.push(checkbox.value);
                    });

                    if (gymCartIds.length > 0) {
                        // Include the selected gym cart IDs in the form data
                        document.querySelector('#gymReservationForm input[name="cart_ids_gym"]').value = JSON
                            .stringify(gymCartIds);
                        // Submit the gym form
                        document.getElementById('gymReservationForm').submit();
                    } else {
                        Swal.fire("Please select items to checkout", "", "warning");
                    }
                } else if (dormCardVisible) {
                    // var dormcarts = {!! json_encode($dormcarts) !!};
                    // Get selected dorm cart IDs
                    const dormCartIds = [];
                    document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
                        dormCartIds.push(checkbox.value);
                    });

                    let isReservorCOA = true;

                    // Loop through dormcarts data
                    for (let i = 0; i < dormcarts.length; i++) {
                        const dormcart = dormcarts[i];
                        if (dormCartIds.includes(dormcart.id.toString())) {
                            // Check if the occupant_type is 'COA'
                            if (dormcart.occupant_type === 'Non COAn') {
                                isReservorCOA = false;
                                break;
                            }
                        }
                    }


                    const surname = document.getElementById('surname').value;
                    const firstname = document.getElementById('firstname').value;
                    const middlename = document.getElementById('middlename').value;
                    const office = document.getElementById('office').value;
                    const office_address = document.getElementById('office_address').value;
                    const position = document.getElementById('position').value;
                    const contact_number_dorm = document.getElementById('contact_number_dorm').value;
                    const email = document.getElementById('email').value;
                    const ei_number = document.getElementById('ei_number').value;
                    const id_presented = document.getElementById('id_presented').value;
                    const pos = document.getElementById('pos').value;
                    const coaEm_name = document.getElementById('coaEm_name').value;
                    const coaEm_relationshipGuest = document.getElementById('coaEm_relationshipGuest').value;
                    const coaEm_office = document.getElementById('coaEm_office').value;
                    const coaEm_office_address = document.getElementById('coaEm_office_address').value;
                    const ptn = document.getElementById('ptn').value;
                    const ptn_contact = document.getElementById('ptn_contact').value;
                    const ptn_home_address = document.getElementById('ptn_home_address').value;

                    if (isReservorCOA === false) {
                        // Check if any field is empty
                        if (!surname || !firstname || !middlename || !office || !office_address || !position ||
                            !
                            contact_number_dorm || !email || !ei_number || !id_presented || !pos || !
                            coaEm_name || !
                            coaEm_relationshipGuest || !coaEm_office || !coaEm_office_address || !ptn || !
                            ptn_contact || !ptn_home_address) {
                            document.getElementById('surname').placeholder = (!surname) ?
                                "Please fill in your surname" : "";
                            document.getElementById('firstname').placeholder = (!firstname) ?
                                "Please fill in your firstname" : "";
                            document.getElementById('middlename').placeholder = (!middlename) ?
                                "Please fill in your middlename" : "";
                            document.getElementById('office').placeholder = (!office) ?
                                "Please fill in your office" : "";
                            document.getElementById('office_address').placeholder = (!office_address) ?
                                "Please fill in your office address" : "";
                            document.getElementById('position').placeholder = (!position) ?
                                "Please fill in your position" : "";
                            document.getElementById('contact_number_dorm').placeholder = (!
                                    contact_number_dorm) ?
                                "Please fill in your contact number dorm" : "";
                            document.getElementById('email').placeholder = (!email) ?
                                "Please fill in your email" :
                                "";
                            document.getElementById('ei_number').placeholder = (!ei_number) ?
                                "Please fill in your EI number" : "";
                            document.getElementById('id_presented').placeholder = (!id_presented) ?
                                "Please fill in your ID presented" : "";
                            document.getElementById('pos').placeholder = (!pos) ? "Please fill in your POS" :
                                "";
                            document.getElementById('coaEm_name').placeholder = (!coaEm_name) ?
                                "Please fill in COA EM name" : "";
                            document.getElementById('coaEm_relationshipGuest').placeholder = (!
                                coaEm_relationshipGuest) ? "Please fill in COA EM relationshipGuest" : "";
                            document.getElementById('coaEm_office').placeholder = (!coaEm_office) ?
                                "Please fill in COA EM office" : "";
                            document.getElementById('coaEm_office_address').placeholder = (!
                                    coaEm_office_address) ?
                                "Please fill in COA EM office address" : "";
                            document.getElementById('ptn').placeholder = (!ptn) ? "Please fill in PTN" : "";
                            document.getElementById('ptn_contact').placeholder = (!ptn_contact) ?
                                "Please fill in PTN contact" : "";
                            document.getElementById('ptn_home_address').placeholder = (!ptn_home_address) ?
                                "Please fill in PTN home address" : "";
                            return; // Prevent form submission
                        }
                    } else {
                        if (!surname || !firstname || !middlename || !office || !office_address || !position ||
                            !
                            contact_number_dorm || !email || !ei_number || !id_presented || !pos || !ptn || !
                            ptn_contact || !ptn_home_address) {
                            document.getElementById('surname').placeholder = (!surname) ?
                                "Please fill in your surname" : "";
                            document.getElementById('firstname').placeholder = (!firstname) ?
                                "Please fill in your firstname" : "";
                            document.getElementById('middlename').placeholder = (!middlename) ?
                                "Please fill in your middlename" : "";
                            document.getElementById('office').placeholder = (!office) ?
                                "Please fill in your office" : "";
                            document.getElementById('office_address').placeholder = (!office_address) ?
                                "Please fill in your office address" : "";
                            document.getElementById('position').placeholder = (!position) ?
                                "Please fill in your position" : "";
                            document.getElementById('contact_number_dorm').placeholder = (!
                                    contact_number_dorm) ?
                                "Please fill in your contact number dorm" : "";
                            document.getElementById('email').placeholder = (!email) ?
                                "Please fill in your email" :
                                "";
                            document.getElementById('ei_number').placeholder = (!ei_number) ?
                                "Please fill in your EI number" : "";
                            document.getElementById('id_presented').placeholder = (!id_presented) ?
                                "Please fill in your ID presented" : "";
                            document.getElementById('pos').placeholder = (!pos) ? "Please fill in your POS" :
                                "";
                            // document.getElementById('coaEm_name').placeholder = (!coaEm_name) ?
                            //     "Please fill in COA EM name" : "";
                            // document.getElementById('coaEm_relationshipGuest').placeholder = (!
                            //     coaEm_relationshipGuest) ? "Please fill in COA EM relationshipGuest" : "";
                            // document.getElementById('coaEm_office').placeholder = (!coaEm_office) ?
                            //     "Please fill in COA EM office" : "";
                            // document.getElementById('coaEm_office_address').placeholder = (!
                            //         coaEm_office_address) ?
                            //     "Please fill in COA EM office address" : "";
                            document.getElementById('ptn').placeholder = (!ptn) ? "Please fill in PTN" : "";
                            document.getElementById('ptn_contact').placeholder = (!ptn_contact) ?
                                "Please fill in PTN contact" : "";
                            document.getElementById('ptn_home_address').placeholder = (!ptn_home_address) ?
                                "Please fill in PTN home address" : "";
                            return; // Prevent form submission
                        }
                    }


                    // Set values of hidden input fields in the form
                    document.getElementById('hidden_surname').value = surname;
                    document.getElementById('hidden_firstname').value = firstname;
                    document.getElementById('hidden_middlename').value = middlename;
                    document.getElementById('hidden_office').value = office;
                    document.getElementById('hidden_office_address').value = office_address;
                    document.getElementById('hidden_position').value = position;
                    document.getElementById('hidden_contact_number_dorm').value = contact_number_dorm;
                    document.getElementById('hidden_email').value = email;
                    document.getElementById('hidden_ei_number').value = ei_number;
                    document.getElementById('hidden_id_presented').value = id_presented;
                    document.getElementById('hidden_pos').value = pos;
                    document.getElementById('hidden_coaEm_name').value = coaEm_name;
                    document.getElementById('hidden_coaEm_relationshipGuest').value = coaEm_relationshipGuest;
                    document.getElementById('hidden_coaEm_office').value = coaEm_office;
                    document.getElementById('hidden_coaEm_office_address').value = coaEm_office_address;
                    document.getElementById('hidden_ptn').value = ptn;
                    document.getElementById('hidden_ptn_contact').value = ptn_contact;
                    document.getElementById('hidden_ptn_home_address').value = ptn_home_address;



                    if (dormCartIds.length > 0) {
                        // Include the selected dorm cart IDs in the form data
                        document.querySelector('#dormReservationForm input[name="cart_ids_dorm"]').value = JSON
                            .stringify(dormCartIds);
                        // Submit the dorm form
                        document.getElementById('dormReservationForm').submit();
                    } else {
                        Swal.fire("Please select items to checkout", "", "warning");
                    }
                }
            } else if (result.isDenied) {
                Swal.fire("Checkout Cancelled", "", "info");
            }
        });
    }

    function goBack() {
        window.history.back();
    }

    // Function to update total price based on selected checkboxes
    function updateTotalPrice() {
        const checkboxes = document.querySelectorAll('.reservation-checkbox');
        const totalPriceDisplay = document.getElementById('total-price');
        let totalPrice = 0;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.dataset.price);
                if (!isNaN(price)) {
                    totalPrice += price;
                }
            }
        });

        totalPriceDisplay.textContent = totalPrice.toFixed(2);
    }

    function clearPrice() {
        const totalPriceDisplay = document.getElementById('total-price');
        totalPriceDisplay.textContent = "0.00";
    }

    document.addEventListener('DOMContentLoaded', function() {
        const gymToggleBtn = document.getElementById('gymReservationsCartToggleBtn');
        const dormToggleBtn = document.getElementById('dormReservationsCartToggleBtn');
        // const gymCard = document.getElementById('gymReservationsCartCard');
        // const dormCard = document.getElementById('dormReservationsCartCard');
        const checkboxes = document.querySelectorAll('.reservation-checkbox');

        gymToggleBtn.addEventListener('click', function() {
            clearPrice();
            // gymCard.style.display = 'block';
            // dormCard.style.display = 'none';
            gymToggleBtn.style.display = 'none';
            dormToggleBtn.style.display = 'block';

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });

        dormToggleBtn.addEventListener('click', function() {

            clearPrice();
            // dormCard.style.display = 'block';
            // gymCard.style.display = 'none';
            dormToggleBtn.style.display = 'none';
            gymToggleBtn.style.display = 'block';

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });

        // Attach updateTotalPrice function to change event of checkboxes
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        // Display initial total price
        updateTotalPrice();
    });

    function resetFormGymCartModal() {
        console.log("Resetting form...");
        var form = document.getElementById("cartToFormModalGymForm");
        if (form) {
            form.reset(); // Reset the form
            console.log("Form reset successfully.");
        } else {
            console.error("Form not found.");
        }
    }

    function resetFormDormCartModal() {
        console.log("Resetting form...");
        var form = document.getElementById("cartToFormModalDormForm");
        if (form) {
            form.reset(); // Reset the form
            console.log("Form reset successfully.");
        } else {
            console.error("Form not found.");
        }
    }

    function confirmDeleteDorm(dormCartId) {
        // Set the dorm cart ID in the delete form
        document.getElementById("dormCartIdDelete").value = dormCartId;

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.querySelector(".delete-form-dorm").submit();
            }
        });
    }

    function confirmDeleteGym(gymCartId) {
        document.getElementById("gymCartIdDelete").value = gymCartId;

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.querySelector(".delete-form-gym").submit();
            }
        });
    }
</script>
@endsection