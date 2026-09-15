<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$escape = static function ($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); };
$product = $product ?? [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $escape($title) ?></title>
    <style>
        :root { --ink:#3d271b; --muted:#756a62; --brand:#93613d; --brand-dark:#754829; --cream:#f5f0e9; --paper:#fffaf4; --line:#ddd2c6; --danger:#8d3734; }
        *{box-sizing:border-box} body{margin:0;background:var(--cream);color:var(--ink);font-family:Arial,Helvetica,sans-serif;line-height:1.6}
        .topbar{background:var(--paper);border-bottom:1px solid var(--line)} .nav,.shell{width:min(920px,calc(100% - 32px));margin:0 auto}
        .nav{min-height:92px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{display:flex;align-items:center;gap:13px;text-decoration:none}.mark{width:48px;height:48px;display:grid;place-items:center;border-radius:50%;background:var(--brand);color:#fff;font:700 23px/1 Georgia,serif}.brand strong{display:block;font:700 20px/1.2 Georgia,serif}.brand small{display:block;color:var(--muted);font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase}.back{min-height:44px;display:inline-flex;align-items:center;padding:8px 16px;border:1px solid var(--line);border-radius:10px;background:#fff;text-decoration:none;font-weight:700}
        .shell{padding:58px 0 80px}.eyebrow{margin:0 0 10px;color:var(--brand-dark);font-size:12px;font-weight:800;letter-spacing:.2em;text-transform:uppercase}h1{margin:0 0 12px;font:500 clamp(42px,6vw,62px)/1 Georgia,serif;letter-spacing:-.03em}.lead{margin:0 0 30px;color:var(--muted)}
        .card{padding:34px;background:var(--paper);border:1px solid var(--line);border-radius:18px;box-shadow:0 12px 34px rgba(67,43,27,.05)}.grid{display:grid;grid-template-columns:1fr 1fr;gap:22px}.wide{grid-column:1/-1}label{display:block;margin-bottom:7px;font-size:14px;font-weight:800}input,textarea{width:100%;min-height:48px;padding:11px 13px;border:1px solid #cdbfb1;border-radius:10px;background:#fffdf9;color:var(--ink);font:inherit}textarea{min-height:130px;resize:vertical}input:focus,textarea:focus{outline:3px solid #dec0a5;outline-offset:1px;border-color:var(--brand)}.errors{margin:0 0 24px;padding:14px 18px;border:1px solid #e4bfba;border-radius:10px;background:#f8e8e6;color:var(--danger)}.buttons{display:flex;gap:12px;margin-top:28px}.submit,.cancel{min-height:48px;display:inline-flex;align-items:center;justify-content:center;padding:10px 20px;border-radius:10px;font-weight:800;cursor:pointer;text-decoration:none}.submit{border:0;background:var(--brand);color:#fff}.submit:hover{background:var(--brand-dark)}.cancel{border:1px solid var(--line);background:#fff;color:var(--ink)}.submit:focus-visible,.cancel:focus-visible,.back:focus-visible{outline:3px solid #c99a70;outline-offset:3px}
        @media(max-width:640px){.brand small{display:none}.shell{padding-top:38px}.card{padding:22px}.grid{grid-template-columns:1fr}.wide{grid-column:auto}.buttons{flex-direction:column}.submit,.cancel{width:100%}}
        @media(prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>
<header class="topbar"><nav class="nav" aria-label="Form navigation"><a class="brand" href="<?= $escape(site_url('products')) ?>"><span class="mark" aria-hidden="true">P</span><span><strong>Dimaapi Product Hub</strong><small>Inventory Management</small></span></a><a class="back" href="<?= $escape(site_url('products')) ?>">Back to products</a></nav></header>
<main class="shell">
    <p class="eyebrow"><?= $editing ? 'Update inventory' : 'New inventory record' ?></p>
    <h1><?= $editing ? 'Edit Product' : 'Add Product' ?></h1>
    <p class="lead"><?= $editing ? 'Adjust this product’s details and stock information.' : 'Add a product and its stock information to your collection.' ?></p>
    <section class="card" aria-label="Product form">
        <?php if (!empty($errors)): ?><div class="errors" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= $escape($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <form method="post" action="<?= $escape($form_action) ?>">
            <div class="grid">
                <div class="wide"><label for="product_name">Product name</label><input id="product_name" name="product_name" maxlength="100" value="<?= $escape($product['product_name'] ?? '') ?>" required></div>
                <div class="wide"><label for="description">Description</label><textarea id="description" name="description" required><?= $escape($product['description'] ?? '') ?></textarea></div>
                <div><label for="price">Price (PHP)</label><input id="price" name="price" type="number" min="0" step="0.01" value="<?= $escape($product['price'] ?? '') ?>" required></div>
                <div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= $escape($product['quantity'] ?? '') ?>" required></div>
            </div>
            <div class="buttons"><button class="submit" type="submit"><?= $editing ? 'Update product' : 'Save product' ?></button><a class="cancel" href="<?= $escape(site_url('products')) ?>">Cancel</a></div>
        </form>
    </section>
</main>
</body>
</html>
