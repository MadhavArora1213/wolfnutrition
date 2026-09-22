<?php
// bundle.php — Combo / Bundle detail page
require_once __DIR__ . '/includes/header.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if ($slug === '') { header('Location: index.php'); exit(); }

$stmt = $pdo->prepare("SELECT * FROM bundles WHERE slug = ? AND status = 1");
$stmt->execute([$slug]);
$bundle = $stmt->fetch();
if (!$bundle) { header('Location: index.php'); exit(); }

$items = get_bundle_items_detail((int)$bundle['id']);
if (empty($items)) { header('Location: index.php'); exit(); }

$individual_total = 0.0;
foreach ($items as $it) { $individual_total += (float)$it['price']; }
$savings = max(0, $individual_total - (float)$bundle['combo_price']);
$savings_pct = $individual_total > 0 ? round((1 - ((float)$bundle['combo_price'] / $individual_total)) * 100) : 0;
$all_in_stock = true;
foreach ($items as $it) { if ((int)$it['stock_qty'] <= 0) { $all_in_stock = false; break; } }

$cat_name = '';
$cat_slug = '';
if (!empty($bundle['category_id'])) {
    $stmt_c = $pdo->prepare("SELECT name, slug FROM categories WHERE id = ?");
    $stmt_c->execute([(int)$bundle['category_id']]);
    $cat = $stmt_c->fetch();
    if ($cat) { $cat_name = $cat['name']; $cat_slug = $cat['slug']; }
}

$banner = !empty($bundle['banner_image']) ? $bundle['banner_image'] : (!empty($items[0]['image_url']) ? $items[0]['image_url'] : 'assets/images/logo.png');
$seo_title = htmlspecialchars($bundle['title']) . ' | Combo Offer | Wolf Nutrition';
$seo_desc = htmlspecialchars(trim(strip_tags($bundle['description'] ?? '')) ?: ('Save ' . $savings_pct . '% on ' . $bundle['title'] . ' — Wolf Nutrition combo pack.'));
?>

<style>
#goldParticles{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0;opacity:0.3;}
.bn-hero{position:relative;z-index:2;margin-top:30px;margin-bottom:50px;display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:start;}
.bn-gallery{background:radial-gradient(circle at center,rgba(212,175,55,0.08) 0%,rgba(8,12,16,0.95) 80%);border:1px solid rgba(212,175,55,0.12);border-radius:24px;height:480px;display:flex;align-items:center;justify-content:center;gap:16px;padding:30px;position:relative;overflow:hidden;}
.bn-gallery img{max-height:90%;max-width:45%;object-fit:contain;filter:drop-shadow(0 20px 40px rgba(8,12,16,0.55));}
.bn-gallery .plus{color:var(--gold-primary);font-size:2rem;font-weight:800;}
.bn-badge{display:inline-block;font-size:0.65rem;font-weight:800;letter-spacing:2px;background:var(--gold-gradient);color:#080C10;padding:5px 16px;border-radius:20px;text-transform:uppercase;margin-bottom:14px;}
.bn-title{font-size:clamp(1.5rem,3vw,2.1rem);font-family:var(--font-heading);font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:0.5px;line-height:1.2;margin-bottom:14px;}
.bn-price-row{display:flex;align-items:baseline;gap:14px;flex-wrap:wrap;margin-bottom:8px;}
.bn-price{font-size:2.2rem;font-weight:800;color:var(--gold-primary);font-family:var(--font-heading);}
.bn-mrp{font-size:1.05rem;color:rgba(255,255,255,0.35);text-decoration:line-through;}
.bn-save{font-size:0.82rem;font-weight:700;color:#4ade80;background:rgba(74,222,128,0.1);border:1px solid rgba(74,222,128,0.2);padding:4px 12px;border-radius:8px;}
.bn-desc{font-size:0.95rem;color:rgba(255,255,255,0.6);line-height:1.75;margin:18px 0 24px;}
.bn-items{border:1px solid rgba(212,175,55,0.12);border-radius:16px;overflow:hidden;margin-bottom:24px;background:rgba(255,255,255,0.02);}
.bn-items-h{padding:14px 18px;border-bottom:1px solid rgba(255,255,255,0.06);font-size:0.72rem;font-weight:800;letter-spacing:1.5px;color:rgba(255,255,255,0.45);text-transform:uppercase;display:flex;justify-content:space-between;}
.bn-item{display:flex;align-items:center;gap:14px;padding:14px 18px;border-bottom:1px solid rgba(255,255,255,0.04);}
.bn-item:last-child{border-bottom:none;}
.bn-item img{width:56px;height:56px;object-fit:contain;background:rgba(212,175,55,0.06);border-radius:10px;padding:6px;}
.bn-item-name{flex:1;font-size:0.88rem;color:#fff;font-weight:600;line-height:1.35;}
.bn-item-name a{color:#fff;text-decoration:none;}
.bn-item-name a:hover{color:var(--gold-primary);}
.bn-item-size{font-size:0.72rem;color:rgba(255,255,255,0.4);margin-top:3px;}
.bn-item-price{font-size:0.9rem;color:rgba(255,255,255,0.5);text-decoration:line-through;white-space:nowrap;}
.bn-actions{display:flex;gap:12px;align-items:center;margin-bottom:16px;}
.bn-qty{display:flex;align-items:center;border:1px solid rgba(255,255,255,0.12);border-radius:12px;overflow:hidden;}
.bn-qty button{width:42px;height:48px;background:transparent;border:none;color:#fff;font-size:1.2rem;cursor:pointer;}
.bn-qty button:hover{background:rgba(212,175,55,0.1);}
.bn-qty input{width:44px;text-align:center;background:transparent;border:none;color:#fff;font-size:1rem;font-weight:700;outline:none;}
.bn-stock{display:flex;align-items:center;gap:8px;font-size:0.82rem;color:#4ade80;margin-bottom:18px;}
.bn-stock.oos{color:#ef4444;}
.bn-related{position:relative;z-index:2;margin-bottom:60px;}
@media(max-width:900px){
  .bn-hero{grid-template-columns:1fr;gap:28px;}
  .bn-gallery{height:300px;}
}
</style>

<canvas id="goldParticles"></canvas>

<div class="container">
  <div class="bn-hero">
    <!-- Gallery -->
    <div class="bn-gallery">
      <?php if (!empty($bundle['banner_image'])): ?>
        <img src="<?php echo htmlspecialchars($bundle['banner_image']); ?>" alt="<?php echo htmlspecialchars($bundle['title']); ?>" style="max-width:100%;">
      <?php else: ?>
        <?php $gimgs = array_slice(array_filter(array_column($items, 'image_url')), 0, 3); ?>
        <?php foreach ($gimgs as $gi => $gimg): ?>
          <?php if ($gi > 0): ?><span class="plus">+</span><?php endif; ?>
          <img src="<?php echo htmlspecialchars($gimg); ?>" alt="">
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if ($savings_pct > 0): ?>
        <span style="position:absolute;top:18px;left:18px;background:var(--gold-primary);color:#080C10;font-size:0.7rem;font-weight:800;padding:6px 14px;border-radius:20px;letter-spacing:1px;">-<?php echo $savings_pct; ?>% OFF</span>
      <?php endif; ?>
    </div>

    <!-- Info -->
    <div>
      <span class="bn-badge"><i class="fas fa-layer-group"></i> Combo Offer</span>
      <?php if ($cat_slug): ?>
        <a href="category/<?php echo htmlspecialchars($cat_slug); ?>" style="font-size:0.72rem;color:var(--gold-primary);text-decoration:none;margin-left:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;"><?php echo htmlspecialchars($cat_name); ?> →</a>
      <?php endif; ?>
      <h1 class="bn-title"><?php echo htmlspecialchars($bundle['title']); ?></h1>

      <div class="bn-price-row">
        <span class="bn-price">₹<?php echo number_format((float)$bundle['combo_price'], 2); ?></span>
        <?php if ($individual_total > 0 && $savings > 0): ?>
          <span class="bn-mrp">₹<?php echo number_format($individual_total, 2); ?></span>
          <span class="bn-save">You save ₹<?php echo number_format($savings, 2); ?> (<?php echo $savings_pct; ?>%)</span>
        <?php endif; ?>
      </div>

      <?php if (!empty($bundle['description'])): ?>
        <div class="bn-desc"><?php echo nl2br(htmlspecialchars($bundle['description'])); ?></div>
      <?php endif; ?>

      <!-- Items -->
      <div class="bn-items">
        <div class="bn-items-h">
          <span>What's inside (<?php echo count($items); ?> items)</span>
          <span>Individual MRP</span>
        </div>
        <?php foreach ($items as $it): ?>
        <div class="bn-item">
          <?php if (!empty($it['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($it['image_url']); ?>" alt="">
          <?php endif; ?>
          <div class="bn-item-name">
            <a href="product/<?php echo htmlspecialchars($it['slug']); ?>"><?php echo htmlspecialchars($it['name']); ?></a>
            <?php if (!empty($it['size_capsules'])): ?>
              <div class="bn-item-size"><?php echo htmlspecialchars($it['size_capsules']); ?></div>
            <?php endif; ?>
          </div>
          <div class="bn-item-price">₹<?php echo number_format((float)$it['price'], 2); ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="bn-stock <?php echo $all_in_stock ? '' : 'oos'; ?>">
        <i class="fas <?php echo $all_in_stock ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
        <?php echo $all_in_stock ? 'In stock — ready to ship' : 'Currently out of stock'; ?>
      </div>

      <div class="bn-actions">
        <div class="bn-qty">
          <button type="button" id="bn-qty-minus">−</button>
          <input type="text" id="bn-qty-input" value="1" readonly>
          <button type="button" id="bn-qty-plus">+</button>
        </div>
        <button class="btn-gold combo-add-btn" id="bn-add-btn"
          style="flex:1;padding:14px 24px;font-size:0.95rem;border-radius:14px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:10px;<?php echo $all_in_stock ? '' : ' opacity:0.5;cursor:not-allowed;'; ?>"
          data-bundle-id="<?php echo (int)$bundle['id']; ?>"
          data-csrf="<?php echo generate_csrf_token(); ?>"
          <?php echo $all_in_stock ? '' : 'disabled'; ?>>
          <i class="fas fa-layer-group"></i> Add Combo to Cart
        </button>
      </div>

      <div style="display:flex;gap:16px;flex-wrap:wrap;font-size:0.75rem;color:rgba(255,255,255,0.4);">
        <span><i class="fas fa-truck-fast" style="color:var(--gold-primary);margin-right:5px;"></i>Free Shipping</span>
        <span><i class="fas fa-shield-halved" style="color:var(--gold-primary);margin-right:5px;"></i>FSSAI Certified</span>
        <span><i class="fas fa-rotate-left" style="color:var(--gold-primary);margin-right:5px;"></i>Easy Returns</span>
      </div>
    </div>
  </div>

  <!-- Related products in this combo -->
  <section class="bn-related">
    <div style="text-align:center;margin-bottom:28px;">
      <span style="display:inline-block;font-size:0.65rem;font-weight:800;letter-spacing:2px;color:var(--gold-primary);text-transform:uppercase;background:rgba(212,175,55,0.06);border:1px solid rgba(212,175,55,0.12);padding:5px 16px;border-radius:20px;">Explore Products</span>
      <h2 style="font-size:1.6rem;font-family:var(--font-heading);font-weight:800;color:#fff;text-transform:uppercase;margin-top:12px;">Products In This Combo</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:22px;">
      <?php foreach ($items as $it):
        $v = $pdo->prepare("SELECT id, sale_price, price, stock_qty FROM product_variants WHERE product_id = ? ORDER BY is_default DESC, price ASC LIMIT 1");
        $v->execute([$it['product_id']]);
        $dv = $v->fetch();
        if (!$dv) continue;
        $dp = $dv['price'] > 0 ? round((($dv['price'] - $dv['sale_price']) / $dv['price']) * 100) : 0;
      ?>
      <div class="product-card tilt-card spotlight-card" style="background:rgba(255,255,255,0.03);border:1px solid rgba(212,175,55,0.1);border-radius:18px;overflow:hidden;position:relative;">
        <?php if ($dp > 0): ?><span class="badge-discount" style="position:absolute;top:12px;left:12px;z-index:2;">-<?php echo $dp; ?>% OFF</span><?php endif; ?>
        <div class="tilt-shine"></div>
        <a href="product/<?php echo htmlspecialchars($it['slug']); ?>" style="display:block;height:200px;background:radial-gradient(circle at center,rgba(212,175,55,0.07) 0%,rgba(8,12,16,0.95) 80%);padding:18px;">
          <img src="<?php echo htmlspecialchars($it['image_url']); ?>" alt="<?php echo htmlspecialchars($it['name']); ?>" style="max-height:100%;max-width:100%;object-fit:contain;margin:0 auto;display:block;">
        </a>
        <div style="padding:18px;">
          <a href="product/<?php echo htmlspecialchars($it['slug']); ?>" style="text-decoration:none;">
            <h3 style="font-size:0.92rem;color:#fff;margin-bottom:8px;font-family:var(--font-heading);font-weight:700;line-height:1.3;"><?php echo htmlspecialchars($it['name']); ?></h3>
          </a>
          <div style="display:flex;align-items:baseline;gap:8px;margin-bottom:12px;">
            <span style="font-size:1.15rem;font-weight:800;color:var(--gold-primary);">₹<?php echo number_format((float)$dv['sale_price'], 2); ?></span>
            <span style="font-size:0.78rem;color:rgba(255,255,255,0.35);text-decoration:line-through;">₹<?php echo number_format((float)$dv['price'], 2); ?></span>
          </div>
          <a href="product/<?php echo htmlspecialchars($it['slug']); ?>" class="btn-gold" style="width:100%;padding:10px;font-size:0.8rem;border-radius:10px;font-weight:700;text-align:center;text-decoration:none;display:block;"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script>
(function(){
  var input = document.getElementById('bn-qty-input');
  var minus = document.getElementById('bn-qty-minus');
  var plus = document.getElementById('bn-qty-plus');
  if (!input) return;
  minus.addEventListener('click', function(){ var v = parseInt(input.value)||1; if (v>1) input.value = v-1; });
  plus.addEventListener('click', function(){ var v = parseInt(input.value)||1; if (v<99) input.value = v+1; });
})();
</script>
