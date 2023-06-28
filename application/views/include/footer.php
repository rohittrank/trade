<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main.js"></script>
<script>
        $(document).ready(function() {
            $('.trade-tab li').click(function() {
                let tabId = $(this).attr('data-id');
                $('#' + tabId).fadeIn().siblings().hide();
                $(this).addClass('active').siblings().removeClass('active');
            });

            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });

            $('#myForm').validate({
                rules: {
                    from_date: {
                        required: true,
                        date: true
                    },
                    to_date: {
                        required: true,
                        date: true
                    }
                },
                messages: {
                    from_date: {
                        required: "From Date is required.",
                        date: "Please enter a valid date."
                    },
                    to_date: {
                        required: "To Date is required.",
                        date: "Please enter a valid date."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "from_date") {
                        error.appendTo("#from_date_error");
                    } else if (element.attr("name") === "to_date") {
                        error.appendTo("#to_date_error");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>