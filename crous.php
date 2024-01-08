<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/crous.css" />
  <title>CROUS</title>
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
        <table class="content-table">
          <thead>
            <tr>
              <th>
                <h1>L</h1>
                <h1>22</h1>
              </th>
              <th>
                <h1>M</h1>
                <h1>23</h1>
              </th>
              <th>
                <h1>M</h1>
                <h1>24</h1>
              </th>
              <th>
                <h1>J</h1>
                <h1>25</h1>
              </th>
              <th>
                <h1>V</h1>
                <h1>26</h1>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h1>Entrée</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Entrée</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Entrée</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Entrée</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td class="noborder">
                <h1>Entrée</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
            </tr>
            <tr>
              <td>
                <h1>Plats</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
                <br>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Plats</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
                <br>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Plats</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
                <br>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Plats</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
                <br>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td class="noborder">
                <h1>Plats</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
                <br>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
            </tr>
            <tr>
              <td>
                <h1>Dessert</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Dessert</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Dessert</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td>
                <h1>Dessert</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
              <td class="noborder">
                <h1>Dessert</h1>
                <p>Oeufs au Feur</p>
                <p>Taboulé Oriental</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <footer class="footer">
        <img class="leftLogo" src="./svg/gauche.svg" alt="">
        <hr>
        <h1><span>22 janvier 2024</span></h1>
        <hr>
        <h1>29 janvier 2024</h1>
        <hr>
        <h1>05 fevrier 2024</h1>
        <hr>
        <h1>12 fevrier 2024</h1>
        <hr>
        <img class="rightLogo" src="./svg/droite.svg" alt="">
      </footer>
    </section>
    <aside class="aside">
      <div class="account">
        <img class="addLogo" src="./svg/add.svg" alt="">
        <div class="bank">
          <img class="bankLogo" src="./svg/bank.svg" alt="">
          <div class="account-info">
            <h1>+ 6,40 €</h1>
            <h2> Solde du 22/01</h2>
          </div>
        </div>
        <div class="qr">
          <div class="qr1">
            <h1>Votre code QR</h1>
            <img class="qrLogo" src="./svg/qrcode.svg" alt="">
          </div>
        </div>
        <button class="button">Accéder à vos paiements</button>
      </div>
      <div class="history">
        <div class="history-title">
          <img class="historyLogo" src="./svg/history.svg" alt="">
          <h1>Historique des transactions</h1>
        </div>
        <hr>
        <div class="transactions">
          <div>
            <h2>-1.00€</h2>
            <p>22/01</p>
          </div>
          <div>
            <h2>-1.00€</h2>
            <p>21/01</p>
          </div>
          <div>
            <h2>-1.60€</h2>
            <p>20/01</p>
          </div>
          <div>
            <h2><span>+10.00€</span></h2>
            <p>20/01</p>
          </div>
        </div>
      </div>
    </aside>
  </div>
</body>

</html>