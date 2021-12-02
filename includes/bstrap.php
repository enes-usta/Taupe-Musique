<div class="modal fade" id="Login" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Connexion</h4>
            </div>
            <div class="modal-body">

                <form role="form" method="post" id="logform">
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

            </div>
            <div class="modal-footer">
                <a class="btn btn-default" href="#Enregistrer" data-toggle="modal">Créer un compte</a>
                <a class="btn btn-primary" href="../Auth/mdp.php">Mot de passe Oublié?</a>
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
                        <input type="text" class="form-control" placeholder="Login" maxlength="100" name="loginbdd"/>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" maxlength="200" name="emailbdd"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" maxlength="100"
                               name="passwordbdd"/>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Nom' maxlength='200' name='nombdd'/>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Prénom' maxlength='100' name='prenombdd'/>
                    </div>
                    <div class='form-group input-append date'>
                        <input type='date' class='form-control' name='datebdd' placeholder='Date de Naissance'
                               id='datePicker'/>
                        <span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='Telephone' maxlength='15'
                               name='telephonebdd'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Adresse' maxlength='500'
                               name='adressebdd'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Ville' maxlength='100'
                               name='villebdd'/>
                    </div>
                    <div class='form-group'>
                        <input type='textarea' class='form-control' placeholder='Code Postal' maxlength='50'
                               name='codepostalbdd'/>
                    </div>
                    <div class='form-group'>
                        <label class='radio-inline active'><input type='radio' name='optradio' checked=''
                                                                  value='Homme'/>Homme</label>
                        <label class='radio-inline'><input type='radio' name='optradio' value='Femme'/>Femme</label>
                    </div>

            </div>
            <div class="modal-footer">

            </div>

        </div>
        </form>
    </div>
</div>

</div>