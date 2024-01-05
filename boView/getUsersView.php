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

                            <button id="editButtonUser' . $user['id_user'] . '" class="editTool">
                                <img src="./svg/boEdit.svg" alt="">
                            </button>

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

    <?php

        foreach ($allUsers as $user) {
            echo '
                <div id="editModalUser' . $user['id_user'] . '" class="profileModalContainer editModal">
                    <div class="profileModal">
            
                        <div class="profilModalTitle">
                            <h1>Editer un utilisateur</h1>
                            <button data-id="' . $user['id_user'] . '" class="profilModalClose">X</button>
                        </div>
            
                        <div class="profileModalFormContainer">
                            <form name="editUserInfo" onsubmit="return validateEditForm(' . $user['id_user'] . ')" class="profileModalForm" action="backoffice.php" method="post">
            
                                <input type="hidden" name="action" value="editUser">
                                <input type="hidden" name="idUser" value="' . $user['id_user'] . '">
            
                                <div class="profilInputContainer firstLastNameInput">
                                    <div>
                                        <label for="editUserPrenom">Prénom :</label>
                                        <input type="text" id="editUserPrenom' . $user['id_user'] . '" name="editUserPrenom" value="' . $user['prenom_user'] . '" required>
                                    </div>
            
                                    <div>
                                        <label for="editUserNom">Nom :</label>
                                        <input type="text" id="editUserNom' . $user['id_user'] . '" name="editUserNom" value="' . $user['nom_user'] . '" required>
                                    </div>
                                </div>
            
                                <div class="profilInputContainer">
                                    <label for="editUserPassword">Mot de passe :</label>
                                    <input type="password" class="editUserPassword" id="editUserPassword' . $user['id_user'] . '" name="editUserPassword" placeholder="Your password">
                                </div>
            
                                <div id="editConfirmPassword' . $user['id_user'] . '" class="profilInputContainer confirmPasswordContainer">
                                    <label for="confirmEditUserPassword">Confirmer le mot de passe:</label>
                                    <input type="password" name="confirmEditUserPassword" id="confirmEditUserPassword' . $user['id_user'] . '">
                                </div>
            
                                <div class="profilInputContainer">
                                    <label for="editUserEmail">Courriel Universitaire :</label>
                                    <input type="email" id="editUserEmail' . $user['id_user'] . '" name="editUserEmail" value="' . $user['login_user'] . '" required>
                                </div>
            
                                <div class="profilInputContainer">
                                    <label for="editUserTelephone">Téléphone :</label>
                                    <input type="tel" id="editUserTelephone' . $user['id_user'] . '" name="editUserTelephone" value="' . $user['phone_user'] . '" required>
                                </div>
            
                                <div id="otherInfoInput">
                                    <div class="otherInputContainer">
                                        <label for="editUserPromotion">Promotion</label>
                                        <select name="editUserPromotion" id="editUserPromotion' . $user['id_user'] . '">
                                            ';

                                        foreach ($allPromotion as $promotion) {

                                                $optionQuery = '<option value="' . $promotion['id_promotion'] . '"';

                                                if ($promotion['id_promotion'] == $user['ext_promotions']) {
                                                    $optionQuery .= ' selected';
                                                }

                                                $optionQuery .= '>' . $promotion['nom_promotion'] . '</option>';

                                            echo $optionQuery;
                                        }

                                    echo '
                                        </select required>
                                    </div>
            
                                    <div class="otherInputContainer">
                                        <label for="editUserTp">Tp :</label>
                                        <select name="editUserTp" id="editUserTp' . $user['id_user'] . '" required>
                                        ';

                                        foreach ($allTp as $tp) {

                                                $optionQuery = '<option value="' . $tp['id_tp'] . '"';

                                                if ($tp['id_tp'] == $user['ext_tp']) {
                                                    $optionQuery .= ' selected';
                                                }

                                                $optionQuery .= '>' . $tp['nom_tp'] . '</option>';

                                            echo $optionQuery;
                                        }

                                        echo '
                                        </select>
                                    </div>
            
                                    <div class="otherInputContainer">
                                        <label for="editUserRole">Role :</label>
                                        <select name="editUserRole" id="editUserRole' . $user['id_user'] . '" required>
                                        ';
    
                                        foreach ($allRole as $role) {
    
                                                $optionQuery = '<option value="' . $role['id_role'] . '"';
    
                                                if ($role['id_role'] == $user['ext_role']) {
                                                    $optionQuery .= ' selected';
                                                }
    
                                                $optionQuery .= '>' . $role['nom_role'] . '</option>';
    
                                            echo $optionQuery;
                                        }

                                        echo '
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
                ';
        }
    
    ?>

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

                    <div id="newUserConfirm" class="profilInputContainer confirmPasswordContainer">
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