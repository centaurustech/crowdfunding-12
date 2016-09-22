<?php

include './include/head.php';
include './include/functions.php';
include './include/header_alt.php';


//cas si c'est un particulier
if ($_POST['type']=='user') {
    //on vérifie si le login/password correspond
    $user_info->execute(array($_POST['login'], $_POST['password']));
    $info = $user_info->fetch();
    $user_info->closeCursor();
    if ($info['login'] == $_POST['login']) {
        $_SESSION['login'] = $info['login'];
        $_SESSION['email'] = $info['email'];
        $_SESSION['nom'] = $info['nom'];
        $_SESSION['prenom'] = $info['prenom'];
        $_SESSION['birth'] = $info['birth'];
        $_SESSION['sex'] = $info['sex'];
        $_SESSION['address'] = $info['address'];
        $_SESSION['phone'] = $info['phone'];
        $_SESSION['type'] = $_POST['type'];

        //redirection automatique vers l'accueil
        echo '<meta http-equiv="refresh" content="=0;URL=index.php" />';
    }
    
    //si login/password incorrect
    else {
?>

<!--passage en HTML--> 
        <section>
            L'association login/mot de passe est incorrect pour ce type d'utilisateur, veuillez réessayer

            <form method="post" action="signin.php"> 
                <input type="radio" name="type" value=user id="user" checked="checked"> <label for="user"> Particulier </label>
                <input type="radio" name="type" value=association id="association"> <label for="association"> Association </label>
                <input type="text" name="login" id="login" placeholder="Identifiant" value=<?php echo $_POST['login'] ?> />
                <input type="password" name="password" id="password" placeholder="Mot de passe" />
                <input type="submit" value="Connexion">
                <input type="submit" formaction="reset.php" value="Réinitialiser le mot de passe" >
            </form>
        </section>
<!--retour en php-->


<?php
    }
}
//si c'est une association
else {
    //vérification login/password
    $association_info->execute(array($_POST['login'], $_POST['password']));
    $info = $association_info->fetch();
    $association_info->closeCursor();
    if ($info['login'] == $_POST['login']) {
        $_SESSION['login'] = $info['login'];
        $_SESSION['email'] = $info['email'];
        $_SESSION['nomAssociation'] = $info['nomAssociation'];
        $_SESSION['address'] = $info['address'];
        $_SESSION['website'] = $info['website'];
        $_SESSION['phone'] = $info['phone'];

        //redirection automatique vers l'accueil
        echo '<meta http-equiv="refresh" content="=60;URL=index.php" />';
    }
    //login/password incorrect
    else {
?>

<!--passage en HTML--> 
        <section>
            L'association login/mot de passe est incorrect pour ce type d'utilisateur, veuillez réessayer

            <form method="post" action="./signin.php"> 
                <input type="radio" name="type" value=user id="user"> <label for="user"> Particulier </label>
                <input type="radio" name="type" value=association id="association" checked="checked"> <label for="association"> Association </label>
                <input type="text" name="login" id="login" placeholder="Identifiant" value=<?php echo $_POST['login'] ?> />
                <input type="password" name="password" id="password" placeholder="Mot de passe" />
                <input type="submit" value="Connexion">
                <input type="submit" formaction="reset.php" value="Réinitialiser le mot de passe">
            </form>
        </section>
<!--retour en php-->

<?php
    }
}

include './include/footer.php';
?>