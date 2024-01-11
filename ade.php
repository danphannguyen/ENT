<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/ade.css" />
  <link rel="icon" href="./svg/symbLogo.svg">
  <title>ENT | ADE</title>
</head>

<body>

  <?php
  session_start();

  include('./UserModel.php');

  if (isset($_SESSION['id'])) {
    $result = getUserInfo($_SESSION['id']);
    include('./View/navbarView.php');
  } else {
    header('Location: login.php');
  }
  ?>

  <div class="container">

    <section class="main">
      <div class="ade">
        <table class="fixed_headers">
          <thead>
            <tr>
              <th class="tab-month">janvier</th>
              <th>L <br><span>22</span></th>
              <th>M <br><span>23</span></th>
              <th>M <br><span>24</span></th>
              <th>J <br><span>25</span></th>
              <th>V <br><span>26</span></th>
              <th>S <br><span>27</span></th>
              <th>D <br><span>28</span></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>08:00</td>
            </tr>
            <tr>
              <td>09:00</td>
              <td class="green" rowspan="4">Autonomie
                SAE 3 -
                ABCD <br>
                <span>IUC 121 <br>
                  IUC 126</span>
              </td>
              <td class="green" rowspan="4">Autonomie
                SAE 3 -
                ABCD <br>
                <span>IUC 121 <br>
                  IUC 126</span>
              </td>
              <td class="rose" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="orange" rowspan="2">R 3.13
                Dévpt <br>
                Back - AB
                IUC 120
              </td>
              <td class="lilas" rowspan="2">SAE 3.02.A
                Produire des
                contenus - AB
                IUC 026
              </td>
            </tr>
            <tr>
              <td>10:00</td>
            </tr>
            <tr>
              <td>11:00</td>
              <td class="mauve" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="fluo" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="turquoise" rowspan="2">R 3.16
                Gestion de
                Projet - AB
                IUC 157
              </td>
            </tr>
            <tr>
              <td>12:00</td>
            </tr>
            <tr>
              <td>13:00</td>
            </tr>
            <tr>
              <td>14:00</td>
              <td class="turquoise" rowspan="2">R 3.16
                Gestion de
                Projet - AB
                IUC 157
              </td>
              <td class="green" rowspan="4">
                Autonomie
                SAE 3 -
                ABCD <br>
                <span>IUC 121 <br>
                  IUC 126</span>
              </td>
              <td class="rose" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="orange-clair" rowspan="2">R 3.16
                Gestion de
                Projet - AB
                IUC 157
              </td>
              <td class="rose" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
            </tr>
            <tr>
              <td>15:00</td>
            </tr>
            <tr>
              <td>16:00</td>
              <td class="ciel" rowspan="2">R 3.13
                Dévpt <br>
                Back - AB
                IUC 120
              </td>
              <td class="lilas" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="violet" rowspan="2">SAE 3.02.A
                Anglais <br>
                Web - AB
                IUC 126
              </td>
              <td class="ciel" rowspan="2">R 3.13
                Dévpt <br>
                Back - AB
                IUC 120
              </td>
            </tr>
            <tr>
              <td>17:00</td>
            </tr>
            <tr class="noborder">
              <td>18:00</td>
            </tr>
          </tbody>
        </table>
      </div>

      <footer class="footer">
        <img class="leftLogo" src="./svg/gauche.svg" alt="">
        <hr>
        <h1><span>22 janvier 2024 - sem 4</span></h1>
        <hr>
        <h1>29 janvier 2024 - sem 5</h1>
        <hr>
        <h1>05 fevrier 2024 - sem 6</h1>
        <hr>
        <h1>12 fevrier 2024 - sem 7</h1>
        <hr>
        <img class="rightLogo" src="./svg/droite.svg" alt="">
      </footer>
    </section>
    <aside class="aside">
      <div class="calendar">
        <div class="calendar-row week-header" data-js="weekheader">
          <!-- Populated by JS -->
        </div>
        <div class="calendar-body">
          <div class="calendar-header" data-js="month">
            <!-- Populated by JS -->
          </div>

          <div class="calendar-row week" data-js="week">
            <!-- Populated by JS -->
          </div>
        </div>
      </div>
      <script>
        let today = getTodaysDate();
        today.numberOfDays = getDaysPerMonth();

        // TODO Make all functions just return values
        // TODO the HTML is probably not that useful without JS, just use a template

        // Gets how many days are in a month
        function getDaysPerMonth() {
          // 30: Sep apr jun nov
          if (today.monthNum !== 8 || today.monthNum !== 3 || today.monthNum !== 5 || today.monthNum !== 10) {
            // 28: feb
            if (today.monthNum === 1) {
              // TODO check for leap year
              return 28;
            } else {
              return 31;
            }
          }
          return 30;
        }

        // Gets today's date and sets the global object
        function getTodaysDate() {
          const today = new Date();
          return {
            day: today.getDate(),
            monthNum: today.getMonth() + 1,
            month: today.toLocaleString('fr', {
              month: 'long'
            }),
            year: today.getFullYear()
          }
        }

        // Sets up the whole calendar
        function setCalendar(year = today.year, month = today.month, day = today.day) {
          // Set calendar month in UI
          setCalendarMonth(month);

          // Set days in calendar + active day
          setCalendarDays(year, today.monthNum, day);
        }

        // Set the month at the top of the calendar
        function setCalendarMonth(month = today.monthNum) {
          document.querySelector('[data-js="month"]').innerHTML = `<h1 class="month">${month}</h1>`;
        }

        // Set the days in the calendar
        function setCalendarDays(year = today.year, month = today.monthNum, day = today.day) {
          const calendarDayStart = new Date(`${year}-${month}-01`).getDay();
          const calendarDays = new Date(year, month, 0).getDate();
          let daysOutput = '';
          let dayCounter = 1;

          // Spit out empty days first
          for (let i = 0; i < calendarDayStart; i++) {
            daysOutput += `<div class="day day-empty" aria-hidden="true"></div>`;
          }
          // Actual calendar days
          for (let n = calendarDayStart; n <= calendarDays; n++) {
            daysOutput += `<div class="day ${dayCounter === today.day ? 'day-active' : ''} ">${dayCounter}</div>`;
            dayCounter++;
          }
          //TODO Maybe output empty cells after the last day of the month too?

          document.querySelector('[data-js="week"]').innerHTML = daysOutput;
        }

        // Sets the weekday text at the top of the calendar week
        function setWeekdays() {
          // TODO I'm just grabbing the first letter of the days of the week, which works in english. If you internationalized this, you might have to do this differently.
          const weekdays = [
            'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'
          ];

          const weekHeader = document.querySelector('[data-js="weekheader"]');
          let weekHeaderOutput = '';

          // Puts weekdays at top of calendar
          weekdays.forEach((value) => {
            weekHeaderOutput += `<div class="day ${value.toLowerCase()}" aria-label="${value}">${value.slice(0, 1)}</div>`
          });
          weekHeader.innerHTML = weekHeaderOutput;
        }

        // Gets the party started
        function init() {
          // Get today's date
          getTodaysDate();

          // Set weekdays in calendar
          setWeekdays();

          // Set the default calendar day, month, and year
          setCalendar();
        }

        init();
      </script>
    </aside>
  </div>
</body>

</html>