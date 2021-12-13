<div class="modal fade" id="Login" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Connexion</h4>
            </div>
            <form role="form" method="post" id="logform">
                <div class="modal-body">

                    <div class="form-group">
                        <div id="reponse" style="display: flex; flex-direction: column;">

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Login d'utilisateur" maxlength="200"
                               name="login"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" maxlength="100"
                               name="password"/>
                    </div>

                    <div class="elem-group">
                        <label for="captcha">Please Enter the Captcha Text</label><br/>
                        <img src="<?= parse_url('captcha.php', PHP_URL_PATH) ?>" alt="CAPTCHA" class="captcha-image">
                        <i class="fas fa-redo refresh-captcha"></i>
                        <br>
                        <input type="text" id="captcha" name="captcha" pattern="[A-Z]{6}">
                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" href="#Enregistrer" data-toggle="modal">Créer un compte</a>
                    <a class="btn btn-primary" href="<?= parse_url('/Auth/ResetPassword/', PHP_URL_PATH) ?>">Mot de
                        passe Oublié?</a>
                    <input class="btn btn-primary" type="submit" value="Log In">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Enregistrer" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Créer un compte</h4>
            </div>
            <div class="modal-body">

                <form role="form" method="post" id="enregform">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Enregistrer">
                    </div>
                    <div class="form-group">
                        <div id="reponse1" style="display: flex; flex-direction: column;">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Login" maxlength="100" name="login"/>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" maxlength="200" name="email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" maxlength="100"
                               name="password"/>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Nom' maxlength='200' name='nom'/>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Prénom' maxlength='100' name='prenom'/>
                    </div>
                    <div class='form-group input-append date'>
                        <input type='date' class='form-control' name='date' placeholder='Date de Naissance'
                               id='datePicker'/>
                        <span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Telephone' maxlength='15'
                               name='telephone'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Adresse' maxlength='500'
                               name='adresse'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Ville' maxlength='100'
                               name='ville'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Code Postal' maxlength='50'
                               name='codepostal'/>
                    </div>
                    <div class='form-group'>
                        <label class='radio-inline active'>
                            <input type='radio' name='sexe' checked='' value='Homme'/>Homme</label>
                        <label class='radio-inline'><input type='radio' name='sexe' value='Femme'/>Femme</label>
                    </div>

                    <div class="elem-group">
                        <label for="captcha2">Please Enter the Captcha Text</label><br/>
                        <img src="<?= parse_url('captcha2.php', PHP_URL_PATH) ?>" alt="CAPTCHA" class="captcha-image2">
                        <i class="fas fa-redo refresh-captcha2"></i>
                        <br>
                        <input type="text" id="captcha2" name="captcha2" pattern="[A-Z]{6}" />
                    </div>
            </div>
            <div class="modal-footer"></div>
        </div>
        </form>
    </div>
</div>

</div>