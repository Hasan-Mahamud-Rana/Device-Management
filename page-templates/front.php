<?php
/*
Template Name: Front
*/
get_header(); ?>

<header id="" role="banner">
	<div class="row">
			<h1 class="text-center "><?php the_title() ?></h1>
	</div>
</header>

<?php do_action( 'foundationpress_before_content' ); ?>
<div class="row">
<table>
  <thead>
    <tr>
      <th>Employee Name</th>
      <th>E-mail</th>
      <th>Device List</th>
      <th>Date of issue</th>
      <th>Date of returns</th>
      <th>Remark</th>
    </tr>
  </thead>
  <tbody>
   
<?php
  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
  $query_args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged
  );
  $the_query = new WP_Query( $query_args );
?>
<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
 <tr>
      <td><?php the_title(); ?></td>
      <td><?php if( get_field('user_mail_id') ): ?>
		<a  href="mailto:<?php the_field('user_mail_id'); ?>"><?php the_field('user_mail_id'); ?></a>
<?php endif; ?>
	  </td>
      <td>
      <?php
		$deviceNames = get_field('device_name');
		if( $deviceNames): ?>
		<ul>
			<?php foreach( $deviceNames as $deviceName ): ?>
				<li><?php echo $deviceName; ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
      </td>
      <td>
      <?php if( get_field('receive_date') ): ?>
		<?php the_field('receive_date'); ?>
<?php endif; ?>
      </td>
       <td>
<?php if( have_rows('date_of_returns') ): ?>
<table>
  <?php while( have_rows('date_of_returns') ): the_row(); 
    $devices = get_sub_field('return_device_name');
    $returnDate = get_sub_field('date_of_return');
    ?>
    <tr>
    <td>
      <?php if( $devices ): ?>
          <ul>
      <?php foreach( $devices as $deviceName ): ?>
        <li><?php echo $deviceName; ?></li>
      <?php endforeach; ?>
    </ul>
      <?php endif; ?>
    </td>
    <td>
      <?php if( $returnDate ): ?>
         <strong><?php echo $returnDate; ?></strong>
      <?php endif; ?>
    </td>
</tr>
  <?php endwhile; ?>
</table>
<?php endif; ?>
      </td>
        <td>
      <?php if( get_field('reason_for_') ): ?>
		<?php the_field('reason_for_'); ?>
<?php endif; ?>
      </td>
</tr><?php endwhile;?>
  </tbody>
</table>
<div class="text-center">
<?php
      if (function_exists(custom_pagination)) {
        custom_pagination($the_query->max_num_pages,"",$paged);
      }
    ?>
</div>
  <?php wp_reset_postdata(); ?>
  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
</div>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer();
