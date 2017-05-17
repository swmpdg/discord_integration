<?php
/**
 * Discord integration
 * Author: Shinka
 * Copyright 2017 Shinka, All Rights Reserved
 *
 * License: http://www.mybb.com/about/license
 *
 */

// Disallow direct access to this file for security reasons
if (!defined('IN_MYBB')) {
	die('Direct initialization of this file is not allowed.');
}

$plugins->add_hook('datahandler_post_insert_thread', 'discord_integration_new_thread');
$plugins->add_hook('datahandler_post_insert_post', 'discord_integration_new_reply');

function discord_integration_info() {
	global $lang;

	$lang->load('discord_integration');

	return array(
		'name'			=> $lang->discord_integration_name,
		'description'	=> $lang->discord_integration_desc,
		'website'		=> '',
		'author'		=> 'Shinka',
		'authorsite'	=> 'https://github.com/kalynrobinson/discord_integration',
		'website' 		=> 'https://github.com/kalynrobinson/discord_integration',
		'version'		=> '2.1.0',
		'guid' 			=> '',
		'codename'		=> 'discord_integration',
		'compatibility' => '18'
	);
}

function discord_integration_install() {
    global $db, $mybb, $lang;

	$lang->load('discord_integration');

    $setting_group = array(
        'name' => 'discord_integration',
        'title' => $lang->discord_integration_settings_title,
        'description' => $lang->discord_integration_settings_desc,
        'disporder' => 5,
        'isdefault' => 0
    );

    $gid = $db->insert_query('settinggroups', $setting_group);

    $setting_array = array(
        'discord_integration_new_thread_webhook' => array(
            'title' => $lang->discord_integration_new_thread_webhook_title,
            'description' => $lang->discord_integration_new_thread_webhook_desc,
            'optionscode' => 'text',
            'disporder' => 1
        ),
        'discord_integration_new_thread_forums' => array(
            'title' => $lang->discord_integration_new_thread_forums_title,
            'description' => $lang->discord_integration_new_thread_forums_desc,
            'optionscode' => 'forumselect',
            'disporder' => 2
        ),
        'discord_integration_new_thread_groups' => array(
            'title' => $lang->discord_integration_new_thread_groups_title,
            'description' => $lang->discord_integration_new_thread_groups_desc,
            'optionscode' => 'groupselect',
            'disporder' => 3
        ),
        'discord_integration_new_thread_users' => array(
            'title' => $lang->discord_integration_new_thread_users_title,
            'description' => $lang->discord_integration_new_thread_users_desc,
            'optionscode' => 'text',
            'disporder' => 4
        ),
        'discord_integration_new_thread_default_nickname' => array(
            'title' => $lang->discord_integration_new_thread_default_nickname_title,
            'description' => $lang->discord_integration_new_thread_default_nickname_desc,
            'optionscode' => 'yesno',
        		'value' => 0,
            'disporder' => 5
        ),
        'discord_integration_new_thread_nickname' => array(
            'title' => $lang->discord_integration_new_thread_nickname_title,
            'description' => $lang->discord_integration_new_thread_nickname_desc,
            'optionscode' => 'text',
            'value' => '',
            'disporder' => 6
        ),
        'discord_integration_new_thread_message' => array(
            'title' => $lang->discord_integration_new_thread_message_title,
            'description' => $lang->discord_integration_new_thread_message_desc,
            'optionscode' => 'textarea',
            'value' => $lang->discord_integration_new_thread_message,
            'disporder' => 7
        ),
        'discord_integration_new_reply_webhook' => array(
            'title' => $lang->discord_integration_new_reply_webhook_title,
            'description' => $lang->discord_integration_new_reply_webhook_desc,
            'optionscode' => 'text',
            'disporder' => 8
        ),
        'discord_integration_new_reply_forums' => array(
            'title' => $lang->discord_integration_new_reply_forums_title,
            'description' => $lang->discord_integration_new_reply_forums_desc,
            'optionscode' => 'forumselect',
            'disporder' => 9
        ),
        'discord_integration_new_reply_groups' => array(
            'title' => $lang->discord_integration_new_reply_groups_title,
            'description' => $lang->discord_integration_new_reply_groups_desc,
            'optionscode' => 'groupselect',
            'disporder' => 10
        ),
        'discord_integration_new_reply_users' => array(
            'title' => $lang->discord_integration_new_reply_users_title,
            'description' => $lang->discord_integration_new_reply_users_desc,
            'optionscode' => 'text',
            'disporder' => 11
        ),
        'discord_integration_new_reply_default_nickname' => array(
            'title' => $lang->discord_integration_new_reply_default_nickname_title,
            'description' => $lang->discord_integration_new_reply_default_nickname_desc,
            'optionscode' => 'yesno',
        		'value' => 0,
            'disporder' => 12
        ),
        'discord_integration_new_reply_nickname' => array(
            'title' => $lang->discord_integration_new_reply_nickname_title,
            'description' => $lang->discord_integration_new_reply_nickname_desc,
            'optionscode' => 'text',
            'value' => '',
            'disporder' => 13
        ),
        'discord_integration_new_reply_message' => array(
            'title' => $lang->discord_integration_new_reply_message_title,
            'description' => $lang->discord_integration_new_reply_message_desc,
            'optionscode' => 'textarea',
            'value' => $lang->discord_integration_new_reply_message,
            'disporder' => 14
        ),
        'discord_integration_additional' => array(
            'title' => $lang->discord_integration_additional_title,
            'description' => $lang->discord_integration_additional_desc,
            'optionscode' => 'textarea',
			'value' => $lang->discord_integration_additional_value,
            'disporder' => 15
        )
    );

    foreach($setting_array as $name => $setting) {
        $setting['name'] = $name;
        $setting['gid'] = $gid;

        $db->insert_query('settings', $setting);
    }

    rebuild_settings();
}

function discord_integration_is_installed() {
    global $settings;

    return isset($settings['discord_integration_new_thread_webhook']);
}

function discord_integration_uninstall() {
    global $db;

		$db->delete_query('settings', "name LIKE 'discord_integration_%'");
    $db->delete_query('settinggroups', "name = 'discord_integration'");

    rebuild_settings();
}

function discord_integration_activate() {
}

function discord_integration_deactivate() {
}

function discord_integration_new_thread() {
	global $mybb;

	send_general('new_thread');
	send_specific('new_thread');
}

function discord_integration_new_reply() {
	global $mybb;

	send_general('new_reply');
	send_specific('new_reply');
}

function send_specific($behavior) {
	global $mybb;

	$specifics = has_specific($behavior);
	if (!$specifics) return;

	foreach ($specifics as $specific) {
		send_request($behavior, $specific['webhook'], $specific['nickname'], $specific['message']);
	}
}

function send_general($behavior) {
	global $mybb;

	$webhook = $mybb->settings['discord_integration_'.$behavior.'_webhook'];
	if (!$webhook || !has_permission($behavior)) return;

	send_request($behavior, $webhook);
}

function explode_alternatives() {
	global $mybb;

	// Trim first '-' from settings
	$settings = substr($mybb->settings['discord_integration_additional'], 1);

	// For some reason, \n--\n doesn't work as a delimiter, so just trim extra whitespace.
	$exploded_settings = explode("\n---", $settings);
	$settings = array();

	foreach ($exploded_settings as $key => $value) {
	    $explosion = explode("\n-", $value);
	    $inner = array();
	    foreach($explosion as $ekey => $evalue) {
	        $inner_explosion = explode('=', $evalue);
	        $inner[strtolower(trim($inner_explosion[0]))] = trim($inner_explosion[1]);
	    }
	    array_push($settings, $inner);
	}

	return $settings;
}

function has_specific($behavior) {
	global $mybb;

	$alternatives = explode_alternatives();
	$to_fulfill = array();
	foreach ($alternatives as $alt) {
		 if (has_specific_permission($alt, $behavior)) array_push($to_fulfill, $alt);
	}

	return $to_fulfill;
}

function has_specific_permission($specific, $behavior) {
	global $mybb, $thread;

	$allowed = true;

	if ($specific['behavior'] != $behavior) return false;

	if ($specific['forums']) {
		$allowed_forums = explode(',', $specific['forums']);
		$forum = $mybb->input['fid'];
		$allowed = in_array((string) $forum, $allowed_forums);
	}

	if ($specific['groups'] && $allowed) {
		$allowed_groups = explode(',', $specific['groups']);
		$user_groups = explode(',', $mybb->user['usergroup']);
		$allowed = count(array_intersect($user_groups, $allowed_groups)) > 0;
	}

	if ($specific['prefixes'] && $allowed) {
		$allowed_prefixes = explode(',', $specific['prefixes']);
		$prefix = $thread['prefix'];
		$allowed = in_array((string) $prefix, $allowed_prefixes);
	}

	if ($specific['users'] && $allowed) {
		$allowed_users = explode(',', $specific['users']);
		$user = $mybb->user['uid'];
		$allowed = in_array((string) $user, $allowed_users);
	}

	return $allowed;
}

function has_permission($behavior) {
	global $mybb, $fid;

	$allowed = true;

	// Not all groups are allowed
	if ($mybb->settings['discord_integration_'.$behavior.'_groups'] != -1) {
		$user_groups = explode(',', $mybb->user['usergroup']);
		$allowed_groups = explode(',', $mybb->settings['discord_integration_'.$behavior.'_groups']);
		$allowed = count(array_intersect($user_groups, $allowed_groups)) > 0;
	}

	// Not all forums are allowed
	if ($mybb->settings['discord_integration_'.$behavior.'_forums'] != -1) {
		$allowed_forums = explode(',', $mybb->settings['discord_integration_'.$behavior.'_forums']);
		$forum = $fid;
		$allowed = in_array($forum, $allowed_forums);
	}

	// Not all users are allowed
	if ($mybb->settings['discord_integration_'.$behavior.'_users']) {
		$allowed_users = explode(',', $mybb->settings['discord_integration_'.$behavior.'_users']);
		$user = $mybb->user['uid'];
		$allowed = in_array($user, $allowed_users);
	}

	return $allowed;
}

function build_request($behavior, $nickname=NULL, $content=NULL) {
	global $cache, $tid, $pid, $mybb, $forum;

	$SHORT_POST_LENGTH = 200;

	if (!$content) $content = $mybb->settings['discord_integration_'.$behavior.'_message'];

	$prefix = $cache->read("threadprefixes")[$mybb->input['threadprefix']]['prefix'];
	
	$userurl = "{$mybb->settings['bburl']}/member.php?action=profile&uid={$mybb->user['uid']}";
	$threadurl = "{$mybb->settings['bburl']}/showthread.php?tid={$tid}&pid={$pid}#pid{$pid}";
	$forumurl = "{$mybb->settings['bburl']}/forumdisplay.php?fid={$forum['fid']}";
	
	if ($mybb->user['username']) $username = $mybb->user['username'];
	else if ($mybb->input['username']) $username = $mybb->input['username'];
	else $username = 'A Guest';

	if ($mybb->user['uid'])
		$userlink = "[{$mybb->user['username']}]($userurl)";
	else
		$userlink = $username;
	
	$threadlink = "[{$mybb->input['subject']}]($threadurl)";	
	$forumlink = "[{$forum['name']}]($forumurl)";	

	if (strlen($mybb->input['message']) > $SHORT_POST_LENGTH)
		$messageshort = substr($mybb->input['message'], 0, $SHORT_POST_LENGTH) . '...';
	else
		$messageshort = $mybb->input['message'];

	if ($nickname) {
		try {
			eval('$request->username = "' . $nickname . '";');
		} catch(Exception $e) {
			$request->username = $nickname;
		}
	} else if (!$mybb->settings['discord_integration_'.$behavior.'_default_nickname']) {
		if ($mybb->settings['discord_integration_'.$behavior.'_nickname'])
			$request->username = $mybb->settings['discord_integration_'.$behavior.'_nickname'];
		else {
			$request->username = $mybb->user['username'];
			$request->avatar_url = $mybb->settings['bburl'] . $mybb->user['avatar'];
		}
	}

	try {
		eval('$content = "' . $content . '";');
	} catch (Exception $e) {
		$content = "Sorry, there's something wrong with your message variables!";
	}

	$request->content = $content;

	return $request;
}

function send_request($behavior, $webhook, $nickname = NULL, $message = NULL) {
	$request = build_request($behavior, $nickname, $message);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $webhook,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => http_build_query($request,'','&'),
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	return $request;
}
