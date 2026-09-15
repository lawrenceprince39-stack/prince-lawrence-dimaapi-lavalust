<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$escape = static function ($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); };
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $escape($title) ?></title>
    <style>
        :root{--ink:#3d271b;--muted:#756a62;--brand:#93613d;--brand-dark:#754829;--cream:#f5f0e9;--paper:#fffaf4;--line:#ddd2c6;--danger:#8d3734}*{box-sizing:border-box}
        body{margin:0;min-height:100vh;display:grid;place-items:center;padding:28px;background:radial-gradient(circle at 15% 10%,#fffaf4 0,transparent 32%),var(--cream);color:var(--ink);font-family:Arial,Helvetica,sans-serif;line-height:1.6}
        .shell{width:min(980px,100%);display:grid;grid-template-columns:1.05fr .95fr;overflow:hidden;border:1px solid var(--line);border-radius:22px;background:var(--paper);box-shadow:0 24px 70px rgba(67,43,27,.1)}
        .intro{padding:64px;background:var(--brand);color:#fffaf4;display:flex;flex-direction:column;justify-content:space-between;gap:80px}.brand{display:flex;align-items:center;gap:14px}.mark{width:54px;height:54px;display:grid;place-items:center;border:1px solid rgba(255,255,255,.55);border-radius:50%;font:700 26px/1 Georgia,serif}.brand strong{display:block;font:700 21px/1.2 Georgia,serif}.brand small{display:block;margin-top:3px;font-size:11px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;opacity:.82}.eyebrow{margin:0 0 12px;font-size:12px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;opacity:.8}.intro h1{margin:0;font:500 clamp(44px,6vw,68px)/.98 Georgia,serif;letter-spacing:-.04em}.intro p{max-width:430px;margin:20px 0 0;font-size:17px;opacity:.86}
        .login{padding:64px 54px;display:flex;flex-direction:column;justify-content:center}.login h2{margin:0;font:700 34px/1.1 Georgia,serif}.sub{margin:10px 0 28px;color:var(--muted)}label{display:block;margin-top:17px;font-size:14px;font-weight:800}input{width:100%;min-height:49px;margin-top:7px;padding:11px 13px;border:1px solid #cdbfb1;border-radius:10px;background:#fffdf9;color:var(--ink);font:inherit}input:focus{outline:3px solid #dec0a5;outline-offset:1px;border-color:var(--brand)}button{width:100%;min-height:50px;margin-top:26px;border:0;border-radius:10px;background:var(--brand);color:#fff;font:800 15px/1 Arial,sans-serif;cursor:pointer;transition:background .2s ease}button:hover{background:var(--brand-dark)}button:focus-visible{outline:3px solid #c99a70;outline-offset:3px}.error,.notice{padding:12px 15px;border-radius:10px}.error{color:var(--danger);background:#f8e8e6;border:1px solid #e4bfba}.notice{color:#315c43;background:#e8f3eb;border:1px solid #c5d8ca}
        @media(max-width:760px){body{padding:16px}.shell{grid-template-columns:1fr}.intro{padding:34px;gap:40px}.intro h1{font-size:44px}.login{padding:36px 28px}}
        @media(prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>
<main class="shell">
    <section class="intro"><div class="brand"><span class="mark" aria-hidden="true">P</span><span><strong>Dimaapi Product Hub</strong><small>Inventory Management</small></span></div><div><p class="eyebrow">LavaLust Laboratory 5</p><h1>Manage products beautifully.</h1><p>A clean inventory workspace for Prince Lawrence Dimaapi’s authenticated CRUD application.</p></div></section>
    <section class="login" aria-labelledby="login-title"><p class="eyebrow">Welcome back</p><h2 id="login-title">Sign in to continue</h2><p class="sub">Access your product collection and stock records.</p>
        <?php if (!empty($error)): ?><p class="error" role="alert"><?= $escape($error) ?></p><?php endif; ?>
        <?php if (!empty($notice)): ?><p class="notice" role="status"><?= $escape($notice) ?></p><?php endif; ?>
        <form method="post" action="<?= $escape(site_url('login')) ?>"><label for="username">Username</label><input id="username" name="username" value="<?= $escape($username ?? '') ?>" autocomplete="username" required><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required><button type="submit">Log in</button></form>
    </section>
</main>
</body>
</html>
