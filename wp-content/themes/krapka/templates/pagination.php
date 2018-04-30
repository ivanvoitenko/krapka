<style>
  .site-pagination {
    margin: 25px 0 15px;
    text-align: center;
  }
  .site-pagination .nav-links {
    white-space: nowrap;
    font-size: 0;
  }
  .site-pagination .page-numbers {
    display: inline-block;
    vertical-align: middle;
    margin: 3px;
    min-width: 30px;
    padding: 5px;
    font-size: 15px;
    border: 1px solid #eb5a23;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
  }
  .site-pagination .page-numbers:hover,
  .site-pagination .page-numbers:active,
  .site-pagination .page-numbers:focus,
  .site-pagination .page-numbers.current {
    background: #eb5a23;
    color: #fff;
  }
  .site-pagination .page-numbers.prev,
  .site-pagination .page-numbers.next,
  .site-pagination .page-numbers.dots {
    background: transparent;
    border: 0;
  }

  .site-pagination .page-numbers.dots {
    padding: 0;
    margin: 0;
    color: inherit !important;
    cursor: default !important;
  }
  .site-pagination .page-numbers.prev:hover,
  .site-pagination .page-numbers.next:hover,
  .site-pagination .page-numbers.prev:active,
  .site-pagination .page-numbers.next:active,
  .site-pagination .page-numbers.prev:focus,
  .site-pagination .page-numbers.next:focus,
  .site-pagination .page-numbers.prev.current,
  .site-pagination .page-numbers.next.current {
    background: transparent;
    color: #eb5a23;
  }
  .site-pagination .screen-reader-text {
    display: none;
  }
  .site-pagination .pagination {
    margin: 0;
  }
  @media(max-width: 467px) {
    .site-pagination .page-numbers.prev,
    .site-pagination .page-numbers.next {
      font-size: 0;
    }
    .site-pagination .page-numbers.prev:before {
      content: "<";
      font-size: 15px;
    }
    .site-pagination .page-numbers.next:after {
      content: ">";
      font-size: 15px;
    }
  }
</style>

<div class="site-pagination">
  <?php the_posts_pagination(); ?>
</div>
