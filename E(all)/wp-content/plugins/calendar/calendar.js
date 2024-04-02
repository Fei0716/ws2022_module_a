jQuery(document).ready(function($){
    var currentDay = new Date();
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    function loadCalendar(){
        $('#calendar-header-data').html(`
            ${months[currentDay.getMonth()]} ${currentDay.getFullYear()}
        `);
        // first of the month

         var date = new Date(currentDay.getFullYear(), currentDay.getMonth(), 1);
        
        // fill up the date before the first day of this month
        var lastMonth = new Date(date);
        lastMonth.setDate(0); // Set to the last day of the previous month
        var html = '<tr class="calendar-dates">';
        for(let i = lastMonth.getDay(); i > 0; i--){
            html += `<td class="calendar-disabled">${lastMonth.getDate()}</td>`;
            lastMonth.setDate(lastMonth.getDate() - 1);
        }
    
        while (date.getMonth() === currentDay.getMonth()) {
            if(date.getDate()== currentDay.getDate()){
                html += `<td class="calendar-today">${date.getDate()}</td>`;
            }else{
                html += `<td>${date.getDate()}</td>`;
            }
            if (getDay(date) === 6) { // Sunday (6)
                html += '</tr><tr class="calendar-dates">'; // Close current row and start a new one
            }
            date.setDate(date.getDate() + 1);
        }
    
        // Append the remaining days in the last row if needed
        if (getDay(date) !== 0) {
            html += '</tr>'; // Close the last row if it's not already closed
        }
        
        // Append the generated HTML to the table body
        $('.calendar-body').append(html);
    }
    function getDay(date){
        // Monday(0) - Sunday(6)
        let day = date.getDay();
        if (day === 0) { // Sunday (0)
            day = 7;
        }
        return day - 1;
    }
    loadCalendar();
    function resetCalendar(){
        $('.calendar-dates').remove();
    }
    $('#btn-calendar-next').on('click', function(){
        currentDay.setMonth(currentDay.getMonth()+1);
        resetCalendar();
        loadCalendar();
    });
    $('#btn-calendar-back').on('click', function(){
        currentDay.setMonth(currentDay.getMonth()-1);
        resetCalendar();
        loadCalendar();
    });
});
