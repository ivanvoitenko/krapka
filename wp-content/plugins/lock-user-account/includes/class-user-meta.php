<?php

/* 
 * Contains functions and definations for user meta
 * 
 * @package LockUserAccount
 * @author babaTechs
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Baba_User_Meta{
    
    public function __construct() {
        //  Add filter to add another action in users' bulk action dropdown
        add_filter( 'bulk_actions-users', array( $this, 'register_bulk_action' ) );
        
        //  Add filter to add another column header in users' listing
        add_filter( 'manage_users_columns' , array( $this, 'register_column_header' ) );
        
        //  Add filter to show output of custom column in users' listing
        add_filter( 'manage_users_custom_column', array( $this, 'output_column' ), 10, 3 );
        
        //  Add filter to process bulk action request
        add_filter( 'handle_bulk_actions-users', array( $this, 'process_lock_action' ), 10, 3 );
    }
    
    /**
     * Add another action in bulk action drop down list on users listing screen
     * 
     * @param array $actions    Array of users bulk actions
     * @return array            Array with adition of Lock action
     */
    public function register_bulk_action( $actions ){
        $actions['lock'] = esc_html__( 'Lock', 'babatechs' );
        $actions['unlock'] = esc_html__( 'Unlock', 'babatechs' );
        return $actions;
    }
    
    /**
     * Add another column header in listing of users
     * 
     * @param array $columns    Array of columns headers
     * @return array            Array with adition of Locked column
     */
    public function register_column_header( $columns ){
        return array_merge( $columns, 
              array( 'locked' => esc_html__( 'Locked', 'babatechs' ) ) );
    }
    
    /**
     * Displaying status of user's account in list of users for Locked column
     * 
     * @param string $output        Output value of custom column
     * @param string $column_name   Column name
     * @param int $user_id          ID of user
     * @return string               Output value of custom column
     */
    public function output_column( $output, $column_name, $user_id ){
        return ( 'locked' === $column_name ) ? get_user_meta( (int)$user_id, sanitize_key( 'baba_user_locked' ), true ) : $output;
    }
    
    /**
     * Processing Lock and Unlock users on request of bulk action
     * 
     * @param string $sendback          Redirect back URL
     * @param string $current_action    Current screen id
     * @param array $userids            Array of users IDs
     * @return string                   Redirect back URL
     */
    public function process_lock_action( $sendback, $current_action, $userids ){
        //  Process lock request
        if( 'lock' === $current_action ){
            foreach( $userids as $userid ){
                update_user_meta( (int)$userid, sanitize_key( 'baba_user_locked' ), 'yes' );
            }
        }
        //  Process unlock request
        elseif( 'unlock' === $current_action ){
            foreach( $userids as $userid ){
                update_user_meta( (int)$userid, sanitize_key( 'baba_user_locked' ), '' );
            }
        }
        return $sendback;
    }
}

new Baba_User_Meta();