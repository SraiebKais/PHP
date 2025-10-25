<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaires</title>
  </head>
  <body>
    <form action="validations.php" method="post">
      <div class="inp-grp">
        <label for="nom_complet">Nom Complet</label>
        <input
          type="text"
          name="nom_complet"
          id="nom_complet"
          value="<?= htmlspecialchars($data["nom_complet"] ?? "") ?>"
        />
      </div>
      <div class="inp-grp">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />
      </div>
      <div class="inp-grp">
        <label for="nom_utilisateur">Nom Utilisateur</label>
        <input type="text" name="nom_utilisateur" id="nom_utilisateur" value="<?= htmlspecialchars(
          $data["nom_utilisateur"] ?? "",
        ) ?>" />
      </div>
      <div class="inp-grp">
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" />
      </div>
      <div class="inp-grp">
        <label for="conf_mdp">Mot de passe</label>
        <input type="password" name="conf_mdp" id="conf_mdp" />
      </div>
      <div class="inp-grp">
        <label for="date_naiss">Date de Naissance</label>
        <input type="text" name="date_naiss" id="date_naiss" value="<?= htmlspecialchars(
          $data["date_naiss"] ?? "",
        ) ?>" />
      </div>
      <div class="inp-grp">
        <label for="tel">Numero Telephone</label>
        <input type="tel" name="tel" id="tel" value="<?= htmlspecialchars($data["tel"] ?? "") ?>" />
      </div>
      <div class="inp-grp">
        <label for="pays">Pays</label>
        <select name="pays" id="pays">
          <option value="tn">Tunisie</option>
          <option value="al">Algerie</option>
          <option value="fr">France</option>
          <option value="rs">Russia</option>
        </select>
      </div>
      <div class="inp-grp">
        <input type="checkbox" name="cond" id="cond" />
        <label for="cond">Accepter les conditions</label>
      </div>
      <div class="sub-btn">
        <button class="btn" type="submit">Valider</button>
      </div>
    </form>
  </body>
</html>
