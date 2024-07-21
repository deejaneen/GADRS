@extends('layout.weblayout')

@section('content')
<div class="container">
    <div class="card" id="EditDormReservationCard">
        <h2>Edit Dorm Reservation</h2>
        <form id="editDormReservationForm" action="{{ route('dorm.update', $reservation->id) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_start_date">Reservation Start Date</label>
                    <input type="date" class="form-control" id="reservation_start_date" name="reservation_start_date" value="{{ $reservation->reservation_start_date }}">
                </div>
                <div class="form-group col-6">
                    <label for="reservation_end_date">Reservation End Date</label>
                    <input type="date" class="form-control" id="reservation_end_date" name="reservation_end_date" value="{{ $reservation->reservation_end_date }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_start_time">Start Time</label>
                    <input type="time" class="form-control" id="reservation_start_time" name="reservation_start_time" value="{{ $reservation->reservation_start_time }}" disabled>
                </div>
                <div class="form-group col-6">
                    <label for="reservation_end_time">End Time</label>
                    <input type="time" class="form-control" id="reservation_end_time" name="reservation_end_time" value="{{ $reservation->reservation_end_time }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="total_price">Total Price</label>
                    <input type="text" class="form-control" id="total_price" name="total_price" value="{{ $reservation->total_price }}" disabled>
                </div>
                <div class="form-group col-6">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $reservation->status }}" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-save-password-changes">Update Reservation</button>
            <button type="button" class="btn btn-go-back" id="back-button">Back</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let isFormChanged = false;
    const form = document.getElementById('editDormReservationForm');
    const originalFormData = new FormData(form);

    form.addEventListener('input', () => {
        const currentFormData = new FormData(form);
        isFormChanged = false;

        for (const [key, value] of originalFormData.entries()) {
            if (value !== currentFormData.get(key)) {
                isFormChanged = true;
                break;
            }
        }
    });

    function showConfirmationDialog(callback) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Go back without saving?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, go back',
            cancelButtonText: 'No, stay here'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    function handleBeforeUnload(event) {
        if (isFormChanged) {
            event.preventDefault();
            event.returnValue = ''; // Prevent default confirmation dialog
            showConfirmationDialog(() => {
                isFormChanged = false; // Reset form change tracker
                window.removeEventListener('beforeunload', handleBeforeUnload);
                window.history.back(); // Use history.back() to navigate
            });
        }
    }

    window.addEventListener('beforeunload', handleBeforeUnload);

    form.addEventListener('submit', function() {
        window.removeEventListener('beforeunload', handleBeforeUnload);
    });

    document.getElementById('back-button').addEventListener('click', function() {
        showConfirmationDialog(() => {
            window.removeEventListener('beforeunload', handleBeforeUnload);
            window.history.back();
        });
    });

    document.querySelectorAll('a').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            if (isFormChanged) {
                event.preventDefault();
                showConfirmationDialog(() => {
                    window.removeEventListener('beforeunload', handleBeforeUnload);
                    window.location.href = anchor.href;
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('reservation_start_date');
        const endDateInput = document.getElementById('reservation_end_date');
        const today = new Date().toISOString().split('T')[0];

        // Set the minimum date for the reservation start date to today
        startDateInput.setAttribute('min', today);

        function validateDates() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            // Update the minimum end date based on the selected start date
            if (startDateInput.value) {
                endDateInput.setAttribute('min', startDate.toISOString().split('T')[0]);
            }

            // Ensure end date is not before the start date
            if (endDate < startDate) {
                endDateInput.value = '';
            }
        }

        // Validate on change of start date
        startDateInput.addEventListener('change', validateDates);

        // Validate on change of end date
        endDateInput.addEventListener('change', validateDates);

        // Initial validation
        validateDates();
    });
</script>
@endsection