<?php
session_start();

$errors = $_SESSION["errors"] ?? [];
$data = $_SESSION["data"] ?? [];
$success_message = $_SESSION["success_message"] ?? "";

// Clear session variables after retrieving them
unset($_SESSION["errors"]);
unset($_SESSION["data"]);
unset($_SESSION["success_message"]);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaires</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container">
      <h2 class="h2">Inscription</h2>
      <form action="validations.php" method="post" novalidate>
        <div class="form-group">
          <label for="nom_complet" class="label">Nom Complet</label>
          <input
            type="text"
            name="nom_complet"
            id="nom_complet"
            class="input"
            value="<?= htmlspecialchars($data["nom_complet"] ?? "") ?>"
            placeholder="Entrez votre nom complet"
            required
          />
          <?php if (isset($errors["nom_complet"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["nom_complet"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="email" class="label">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="input"
            value="<?= htmlspecialchars($data["email"] ?? "") ?>"
            placeholder="Entrez votre email"
            required
          />
          <?php if (isset($errors["email"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["email"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="nom_utilisateur" class="label">Nom Utilisateur</label>
          <input
            type="text"
            name="nom_utilisateur"
            id="nom_utilisateur"
            class="input"
            value="<?= htmlspecialchars($data["nom_utilisateur"] ?? "") ?>"
            placeholder="Choisissez un nom d'utilisateur"
            required
          />
          <?php if (isset($errors["nom_utilisateur"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["nom_utilisateur"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="mdp" class="label">Mot de passe</label>
          <input
            type="password"
            name="mdp"
            id="mdp"
            class="input"
            placeholder="Créez un mot de passe"
            required
          />
          <?php if (isset($errors["mdp"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["mdp"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="conf_mdp" class="label">Confirmer le mot de passe</label>
          <input
            type="password"
            name="conf_mdp"
            id="conf_mdp"
            class="input"
            placeholder="Confirmez votre mot de passe"
            required
          />
          <?php if (isset($errors["conf_mdp"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["conf_mdp"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="date_naiss" class="label">Date de Naissance</label>
          <input
            type="date"
            name="date_naiss"
            id="date_naiss"
            class="input"
            value="<?= htmlspecialchars($data["date_naiss"] ?? "") ?>"
            required
          />
          <?php if (isset($errors["date_naiss"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["date_naiss"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="tel" class="label">Numero Telephone</label>
          <input
            type="tel"
            name="tel"
            id="tel"
            class="input"
            value="<?= htmlspecialchars($data["tel"] ?? "") ?>"
            placeholder="Entrez votre numéro de téléphone"
            required
          />
          <?php if (isset($errors["tel"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["tel"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="pays" class="label">Pays</label>
          <select name="pays" id="pays" class="input" required>
            <option value="">Sélectionnez un pays</option>
            <option value="tn" <?= isset($data["pays"]) && $data["pays"] === "tn"
              ? "selected"
              : "" ?>>Tunisie</option>
            <option value="al" <?= isset($data["pays"]) && $data["pays"] === "al"
              ? "selected"
              : "" ?>>Algerie</option>
            <option value="fr" <?= isset($data["pays"]) && $data["pays"] === "fr"
              ? "selected"
              : "" ?>>France</option>
            <option value="rs" <?= isset($data["pays"]) && $data["pays"] === "rs"
              ? "selected"
              : "" ?>>Russia</option>
          </select>
          <?php if (isset($errors["pays"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["pays"]) ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
          <input
            type="checkbox"
            name="cond"
            id="cond"
            <?= isset($data["cond"]) ? "checked" : "" ?>
            required
          />
          <label for="cond" class="label" style="margin-bottom: 0;"
            >Accepter les conditions</label
          >
          <?php if (isset($errors["cond"])): ?>
            <span class="error-message"><?= htmlspecialchars($errors["cond"]) ?></span>
          <?php endif; ?>
        </div>
        <button class="button" type="submit">Valider</button>
      </form>
    </div>

    <div class="message-container">
      <?php if (!empty($success_message)): ?>
        <div class="message-sidebar success">
          <h3>Succès!</h3>
          <p><?= htmlspecialchars($success_message) ?></p>
        </div>
      <?php endif; ?>

      <?php if (!empty($errors)): ?>
        <div class="message-sidebar error">
          <h3>Erreurs de validation:</h3>
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
