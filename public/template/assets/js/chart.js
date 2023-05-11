// console.log(weekly_review); 
// console.log(monthly_review);
let arr = [];
let dates = [];

//Weekly
for(let i = 0; i < weekly_review.length; i++){
  let rating = parseFloat(weekly_review[i]['average_rating']);
  let dayOfWeek = parseInt(weekly_review[i]['day_of_week']) - 1;

  let dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  let dayLabel = dayNames[dayOfWeek];

  arr.push(rating);
  dates.push(dayLabel);
}


// Monthly
let arr_monthly = [];
let months = [];
let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

for (let i = 0; i < monthly_review.length; i++) {
    let rating = parseFloat(monthly_review[i]['average_rating']);
    let month = parseInt(monthly_review[i]['month']) - 1;
    let year = monthly_review[i]['year'];

    arr_monthly.push(rating);
    months.push(`${monthNames[month]} ${year}`);
}

//Daily Income 
let income_arr = [];
let income_dates = [];
console.log(daily_incomes); //returns true
for(let i = 0; i < daily_incomes.length; i++){
    let income = parseFloat(daily_incomes[i]['total_income']);
    let date = new Date(daily_incomes[i]['date'])

    let dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    let dayOfWeek = dayNames[date.getDay()];

    income_arr.push(income);
    income_dates.push(dayOfWeek);
}

//Total Ratings 
let rating_counts = [];
let ratings = [];

for (let i = 0; i < rating_count.length; i++) {
    let count = parseInt(rating_count[i]['count']);
    let rating = parseInt(rating_count[i]['rating']);

    rating_counts.push(count);
    ratings.push(rating);
}

//Appointment Trends
let appointment_arr = [];
let appointment_dates = [];

for (let i = 0; i < appointment_trends.length; i++) {
    let total_appointments = parseInt(appointment_trends[i]['total_appointments']);
    let date = new Date(appointment_trends[i]['date'])

    let dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    let dayOfWeek = dayNames[date.getDay()];
    let formattedDate = `${dayOfWeek}, ${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`;

    appointment_arr.push(total_appointments);
    appointment_dates.push(formattedDate);
}
console.log(popular_services);
// Popular Services
let service_names = [];
let service_counts = [];

for (let i = 0; i < popular_services.length; i++) {
    let name = popular_services[i]['name'];
    let count = parseInt(popular_services[i]['count']);

    service_names.push(name);
    service_counts.push(count);
}
console.log(service_names);
console.log(service_counts);
function load_charts(id, type, labels, title_of_chart, data_array){
    const ctx = document.getElementById(id);

    new Chart(ctx, {
      type: type,
      data: {
        labels: labels,
        datasets: [{
          label: title_of_chart,
          data: data_array,
          borderWidth: 4
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
}



load_charts("Weekly Report", 'line', dates, "Report of Last 7 Days",arr);
load_charts("Monthly Report", 'bar', months, "Report of Last 12 Months", arr_monthly);
load_charts("Total Rating Report", 'doughnut', ratings, "Rating Count", rating_counts);

load_charts("Income Report", 'line', income_dates, "Income of Last 7 Days", income_arr);
load_charts("Appointment Trends", 'bar', appointment_dates, "Appointments in Last 2 Months", appointment_arr);
load_charts("Popular Services", 'pie', service_counts, "Top 5 Popular Services", service_names);
