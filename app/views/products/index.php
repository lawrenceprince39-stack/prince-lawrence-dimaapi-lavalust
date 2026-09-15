<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$productCount = is_array($products ?? null) ? count($products) : 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $escape($title) ?></title>
    <style>
        :root { --ink:#3d271b; --muted:#756a62; --brand:#93613d; --brand-dark:#754829; --cream:#f5f0e9; --paper:#fffaf4; --line:#ddd2c6; --success-bg:#e8f3eb; --success-text:#315c43; --danger:#8d3734; }
        * { box-sizing:border-box; }
        body { margin:0; background:var(--cream); color:var(--ink); font-family:Arial,Helvetica,sans-serif; line-height:1.6; }
        a { color:inherit; }
        .topbar { background:rgba(255,250,244,.96); border-bottom:1px solid var(--line); }
        .nav,.workspace { width:min(1400px,calc(100% - 40px)); margin:0 auto; }
        .nav { min-height:98px; display:flex; align-items:center; justify-content:space-between; gap:28px; }
        .brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
        .brand-mark { width:52px; height:52px; display:grid; place-items:center; border-radius:50%; color:#fffaf4; background:var(--brand); font:700 25px/1 Georgia,serif; }
        .brand-name { display:block; font:700 21px/1.15 Georgia,serif; letter-spacing:.01em; }
        .brand-subtitle { display:block; margin-top:4px; color:var(--muted); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; }
        .nav-links { display:flex; align-items:center; gap:14px; }
        .nav-link { padding:11px 8px; font-weight:700; text-decoration:none; }
        .user-pill,.logout { min-height:44px; display:inline-flex; align-items:center; border:1px solid var(--line); border-radius:999px; padding:8px 18px; text-decoration:none; }
        .logout { border-radius:10px; background:var(--paper); font-weight:700; }
        .workspace { padding:68px 0 80px; }
        .notice,.error { margin:0 0 30px; padding:18px 22px; border:1px solid #c5d8ca; border-radius:12px; }
        .notice { background:var(--success-bg); color:var(--success-text); }
        .error { background:#f8e8e6; border-color:#e4bfba; color:var(--danger); }
        .hero { display:flex; align-items:end; justify-content:space-between; gap:28px; margin:0 0 38px; }
        .eyebrow { margin:0 0 12px; color:var(--brand-dark); font-size:13px; font-weight:800; letter-spacing:.22em; text-transform:uppercase; }
        h1 { margin:0; font:500 clamp(48px,6vw,78px)/.98 Georgia,'Times New Roman',serif; letter-spacing:-.04em; }
        .lead { margin:20px 0 0; color:var(--muted); font-size:18px; }
        .primary { min-height:54px; display:inline-flex; align-items:center; justify-content:center; gap:9px; flex:0 0 auto; padding:12px 22px; border-radius:10px; background:var(--brand); color:#fff; font-weight:800; text-decoration:none; transition:background .2s ease,box-shadow .2s ease; }
        .primary:hover { background:var(--brand-dark); box-shadow:0 8px 20px rgba(117,72,41,.16); }
        .primary:focus-visible,.action:focus-visible,.logout:focus-visible,.nav-link:focus-visible { outline:3px solid #c99a70; outline-offset:3px; }
        .panel { overflow:hidden; background:var(--paper); border:1px solid var(--line); border-radius:18px; box-shadow:0 12px 34px rgba(67,43,27,.05); }
        .panel-head { min-height:92px; padding:22px 30px; display:flex; align-items:center; justify-content:space-between; gap:20px; border-bottom:1px solid var(--line); }
        .panel-title { margin:0; font:700 27px/1.2 Georgia,serif; }
        .counter { padding:6px 14px; border-radius:999px; background:#fbf4eb; font-size:13px; font-weight:800; }
        .table-scroll { overflow-x:auto; }
        table { width:100%; min-width:940px; border-collapse:collapse; }
        th { padding:20px 24px; background:#f7f1e9; color:#6b584b; font-size:12px; letter-spacing:.14em; text-align:left; text-transform:uppercase; }
        td { padding:25px 24px; border-top:1px solid var(--line); color:#5c5048; vertical-align:middle; }
        tbody tr { transition:background .2s ease; }
        tbody tr:hover { background:#fffdf9; }
        .id { color:var(--ink); font-weight:700; white-space:nowrap; }
        .product-name { color:var(--ink); font-weight:800; }
        .description { max-width:420px; }
        .numeric,.date { white-space:nowrap; }
        .actions { display:flex; gap:8px; flex-wrap:wrap; }
        .actions form { margin:0; }
        .action { min-height:40px; display:inline-flex; align-items:center; justify-content:center; padding:7px 13px; border:1px solid var(--line); border-radius:9px; background:transparent; color:var(--ink); font:700 14px/1 Arial,sans-serif; text-decoration:none; cursor:pointer; transition:background .2s ease,border-color .2s ease; }
        .action:hover { background:#f3e8dc; border-color:#c7ad96; }
        .danger { color:var(--danger); }
        .empty { padding:50px 24px; text-align:center; }
        @media (max-width:760px) { .nav,.workspace{width:min(100% - 28px,1400px)} .nav{padding:18px 0;align-items:flex-start} .brand-subtitle,.user-pill,.nav-link{display:none} .workspace{padding-top:42px} .hero{align-items:stretch;flex-direction:column} h1{font-size:46px} .primary{align-self:flex-start} .panel-head{padding:20px} th,td{padding-left:18px;padding-right:18px} }
        @media (prefers-reduced-motion:reduce) { * { scroll-behavior:auto!important; transition:none!important; } }
    </style>
</head>
<body>
<header class="topbar">
    <nav class="nav" aria-label="Product navigation">
        <a class="brand" href="<?= $escape(site_url('products')) ?>">
            <span class="brand-mark" aria-hidden="true">P</span>
            <span><span class="brand-name">Dimaapi Product Hub</span><span class="brand-subtitle">Inventory Management</span></span>
        </a>
        <div class="nav-links">
            <a class="nav-link" href="<?= $escape(site_url('products')) ?>">Products</a>
            <span class="user-pill">Prince Lawrence</span>
            <a class="logout" href="<?= $escape(site_url('logout')) ?>">Log out</a>
        </div>
    </nav>
</header>
<main class="workspace">
    <?php if (!empty($notice)): ?><p class="notice" role="status"><?= $escape($notice) ?></p><?php endif; ?>
    <?php if (!empty($error)): ?><p class="error" role="alert"><?= $escape($error) ?></p><?php endif; ?>
    <section class="hero" aria-labelledby="page-title">
        <div><p class="eyebrow">Inventory workspace</p><h1 id="page-title">Product Collection</h1><p class="lead">Review stock levels, pricing, and product details in one place.</p></div>
        <a class="primary" href="<?= $escape(site_url('products/create')) ?>"><svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Add product</a>
    </section>
    <section class="panel" aria-labelledby="records-title">
        <div class="panel-head"><h2 class="panel-title" id="records-title">Product records</h2><span class="counter"><?= $escape($productCount) ?> <?= $productCount === 1 ? 'record' : 'records' ?></span></div>
        <div class="table-scroll"><table>
            <thead><tr><th>ID</th><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
            <?php if (empty($products)): ?><tr><td class="empty" colspan="7">No products found. Add your first product to begin.</td></tr>
            <?php else: foreach ($products as $product): ?>
                <tr>
                    <td class="id">#<?= $escape($product['id']) ?></td>
                    <td class="product-name"><?= $escape($product['product_name']) ?></td>
                    <td class="description"><?= $escape($product['description']) ?></td>
                    <td class="numeric">₱<?= $escape(number_format((float) $product['price'], 2)) ?></td>
                    <td class="numeric"><?= $escape($product['quantity']) ?></td>
                    <td class="date"><?= $escape(date('M j, Y', strtotime($product['created_at']))) ?></td>
                    <td><div class="actions"><a class="action" href="<?= $escape(site_url('products/edit/' . (int) $product['id'])) ?>">Edit</a><form method="post" action="<?= $escape(site_url('products/delete/' . (int) $product['id'])) ?>" onsubmit="return confirm('Delete this product?');"><button class="action danger" type="submit">Delete</button></form></div></td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table></div>
    </section>
</main>
</body>
</html>
