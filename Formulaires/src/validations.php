<?php

$errors = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $safe_post = sanitize_input($_POST);
  $errors = validate_form($safe_post);
  $data = $safe_post;

  if (empty($errors)) {
    echo "Inscription réussie";
  } else {
    echo "<pre>";
    var_dump($errors);
    echo "</pre>";
  }
}

/**
 * Sanitizes input data by trimming whitespace and converting special characters to HTML entities.
 *
 * @param array $data The input array, typically $_POST or $_GET.
 * @return array The sanitized array.
 */
function sanitize_input($data)
{
  $nouv_data = [];
  foreach ($data as $k => $v) {
    $nouv_data[$k] = htmlspecialchars(trim($v), ENT_QUOTES, "UTF-8");
  }
  return $nouv_data;
}

/**
 * Validates the form input data against a set of rules.
 *
 * @param array $input The sanitized input data from the form.
 * @return array An associative array of errors, where the key is the field name and the value is the error message.
 */
function validate_form($input)
{
  $errors = []; // Standardize on $errors for the validation array

  if (
    empty($input["nom_complet"]) ||
    strlen($input["nom_complet"]) < 3 ||
    strlen($input["nom_complet"]) > 50
  ) {
    $errors["nom_complet"] =
      "Le nom ne doit pas être vide et doit avoir une longueur entre 3 et 50 caractères.";
  }

  if (!filter_var($input["email"], FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Email invalide.";
  }

  if (!preg_match('/^[a-zA-Z0-9]{5,20}$/', $input["nom_utilisateur"])) {
    // Corrected error message for nom_utilisateur
    $errors["nom_utilisateur"] =
      "Le nom d'utilisateur doit contenir entre 5 et 20 caractères alphanumériques.";
  }

  if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $input["mdp"])) {
    // Changed key to 'mdp' to match input field name
    $errors["mdp"] =
      "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole, et faire au moins 8 caractères.";
  }

  if ($input["mdp"] !== $input["conf_mdp"]) {
    $errors["conf_mdp"] = "Les mots de passe ne correspondent pas.";
  }

  // Check if date_naiss is set and valid before creating DateTime objects
  if (empty($input["date_naiss"])) {
    $errors["date_naiss"] = "La date de naissance est requise.";
  } else {
    try {
      $birthdate = new DateTime($input["date_naiss"]);
      $today = new DateTime();
      $age = $today->diff($birthdate)->y;
      if ($age < 13) {
        $errors["date_naiss"] = "Vous devez avoir au moins 13 ans.";
      }
    } catch (Exception $e) {
      $errors["date_naiss"] = "Format de date de naissance invalide.";
    }
  }

  if (!preg_match('/^\+?[0-9\s\-]{7,15}$/', $input["tel"])) {
    $errors["tel"] = "Numéro de téléphone invalide.";
  }

  if (empty($input["pays"])) {
    $errors["pays"] = "Veuillez sélectionner un pays.";
  }

  if (!isset($input["cond"])) {
    $errors["cond"] = "Vous devez accepter les conditions.";
  }

  return $errors;
}
