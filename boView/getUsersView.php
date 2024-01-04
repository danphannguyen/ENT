<h1>Listes de tout les utilisateurs</h1>

<button id="boAddButton">
    <img src="./svg/boAdd.svg" alt="">
</button>

<div id="usersListContainer">

    <table class="usersTable" border="0">
        <tr>
            <th></th>
            <th>Information</th>
            <th>Rôle</th>
            <th>Outils</th>
        </tr>

        <?php

        foreach ($allUsers as $user) {

            echo '
                <tr>
                    <td>
                        <img class="boProfilePicture" src="' . $user['photo_user'] .  '" alt="">
                    </td>
                    <td>
                        ' . $user['prenom_user'] . ' ' . $user['nom_user'] . '
                        <br>
                        ' . $user['nom_promotion'] . ' - ' .  $user['nom_tp'] . '
                    </td>
                    <td>
                        ' . $user['nom_role'] .  '
                    </td>
                    <td>
                        <div class="toolsContainer">

                            <form action="backoffice.php" method="post">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="' . $user['id_user'] . '">
                                <button class="editTool " onclick="confirmDelete()" type="submit">
                                    <img src="./svg/boEdit.svg" alt="">
                                </button>
                            </form>

                            <form class="deleteForm" action="backoffice.php" method="post">
                                <input type="hidden" name="action" value="deleteUser">
                                <input type="hidden" name="idUser" value="' . $user['id_user'] . '">
                                <button class="deleteTool" type="submit">
                                    <img src="./svg/boDelete.svg" alt="">
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                ';
        }

        ?>

    </table>

    <div id="addUserModal" class="profileModalContainer">
        <div class="profileModal">

            <div class="profilModalTitle">
                <h1>Ajouter un utilisateur</h1>
                <button id="userInformationModalClose" class="profilModalClose">X</button>
            </div>

            <div class="profileModalFormContainer">
                <form name="NewUserInfo" onsubmit="return validateForm()" class="profileModalForm" action="backoffice.php" method="post">

                    <input type="hidden" name="action" value="addUser">

                    <div class="profilInputContainer firstLastNameInput">
                        <div>
                            <label for="newUserPrenom">Prénom :</label>
                            <input type="text" id="newUserPrenom" name="newUserPrenom" placeholder="Dan" required>
                        </div>

                        <div>
                            <label for="newUserNom">Nom :</label>
                            <input type="text" id="newUserNom" name="newUserNom" placeholder="Phan" required>
                        </div>
                    </div>

                    <div class="profilInputContainer">
                        <label for="newUserPassword">Mot de passe :</label>
                        <input type="password" id="newUserPassword" name="newUserPassword" placeholder="Your password">
                    </div>

                    <div class="profilInputContainer confirmPasswordContainer">
                        <label for="confirmNewUserPassword">Confirmer le mot de passe:</label>
                        <input type="password" id="confirmNewUserPassword">
                    </div>

                    <div class="profilInputContainer">
                        <label for="newUserEmail">Courriel Universitaire :</label>
                        <input type="email" id="newUserEmail" name="newUserEmail" placeholder="danphannguyen@univ-effel.fr" required>
                    </div>

                    <div class="profilInputContainer">
                        <label for="newUserTelephone">Téléphone :</label>
                        <input type="tel" id="newUserTelephone" name="newUserTelephone" placeholder="+33 6 68 95 62 73" required>
                    </div>

                    <div id="otherInfoInput">
                        <div class="otherInputContainer">
                            <label for="addUserPromotion">Promotion</label>
                            <select name="newUserPromotion" id="addUserPromotion">
                                <?php
                                foreach ($allPromotion as $promotion) {
                                    echo '<option value="' . $promotion['id_promotion'] . '">' . $promotion['nom_promotion'] . '</option>';
                                }
                                ?>
                            </select required>
                        </div>

                        <div class="otherInputContainer">
                            <label for="addUserTp">Tp :</label>
                            <select name="newUserTp" id="addUserTp" required>
                                <?php
                                foreach ($allTp as $tp) {
                                    echo '<option value="' . $tp['id_tp'] . '">' . $tp['nom_tp'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="otherInputContainer">
                            <label for="addUserRole">Role :</label>
                            <select name="newUserRole" id="addUserRole" required>
                                <?php
                                foreach ($allRole as $role) {
                                    echo '<option value="' . $role['id_role'] . '">' . $role['nom_role'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="profilModalFooter">
                        <input class="profilModalSubmit" type="submit" value="Ajouter">
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>