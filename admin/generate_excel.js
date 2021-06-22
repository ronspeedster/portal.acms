$(document).ready(function()
    {
        $('#date').on('change', function()
            {
                toggleDateField($(this).val());
            }
        );  

        function toggleDateField(value)
        {
            $('.date-field').each(function(index, field)
                {
                    field.classList.add('d-none');          
                }
            );

            switch(value)
            {
                case 'from and to':
                    $('.date-field.date-range').removeClass('d-none') 
                    break;

                case 'month': 
                    $('.date-field.date-month').removeClass('d-none') 
                    break;

                case 'year': 
                    $('.date-field.date-year').removeClass('d-none') 
                    break;  

                default: 
                    break; 
            };
        }
    }
);
