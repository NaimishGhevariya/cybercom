<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $this->getUrlObject()->getUrl('grid', 'product'); ?>">
      <h1><i style="color:#0b5ed7" class="fab fa-cloudsmith"></i>&nbsp;QuesteCom</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'product'); ?>"><i class="fas fa-tshirt"></i> Products</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'category'); ?>"><i class="fas fa-boxes"></i> Category</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'customer'); ?>"><i class="fas fa-user"></i> Customer</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'customergroup'); ?>"><i class="fas fa-users"></i> CustomerGroup</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'paymentmethod'); ?>"><i class="fas fa-tags"></i> Payment</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'shippingmethod'); ?>"><i class="fas fa-shipping-fast"></i> Shipping</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'cms'); ?>"><i class="fas fa-file-code"></i> CMS</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'attribute'); ?>"><i class="fas fa-cubes"></i> Attribute</a>
        <a class="nav-link float-end" href="<?php echo $this->getUrlObject()->getUrl('grid', 'admin'); ?>"><i class="fas fa-user-shield"></i> Admin</a>
      </div>
    </div>
  </div>
</nav>