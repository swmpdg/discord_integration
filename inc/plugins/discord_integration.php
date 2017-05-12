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

$plugins->add_hook('newthread_do_newthread_end', 'discord_integration_new_thread');
$plugins->add_hook('newreply_do_newreply_end', 'discord_integration_new_reply');

function discord_integration_info() {
	return array(
		'name'			=> 'Discord Integration',
		'description'	=> 'Automatically send messages to your Discord channels when a user does something!',
		'website'		=> '',
		'author'		=> 'Shinka',
		'authorsite'	=> 'https://github.com/kalynrobinson/discord_integration',
		'website' => 'https://github.com/kalynrobinson/discord_integration',
		'version'		=> '2.1.0',
		'guid' 			=> '',
		'codename'		=> 'discord_integration',
		'compatibility' => '18'
	);
}

function discord_integration_install() {
    global $db, $mybb;

    $setting_group = array(
        'name' => 'discord_integration',
        'title' => 'Discord Integration Settings',
        'description' => 'Automatically send messages to your Discord channels when a user does something!',
        'disporder' => 5,
        'isdefault' => 0
    );

    $gid = $db->insert_query('settinggroups', $setting_group);

    $setting_array = array(
        'discord_integration_new_thread_webhook' => array(
            'title' => 'New Thread Webhook',
            'description' => 'Webhook for the channel that new thread notifications will be posted in. Leave blank to disable. See <a href="https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks">Intro to Webhooks</a> to learn how to find the webhook for your channel.',
            'optionscode' => 'text',
            'disporder' => 1
        ),
        'discord_integration_new_thread_forums' => array(
            'title' => 'New Thread Forums',
            'description' => 'Sends a Discord message when a new thread is posted in the specified forums.',
            'optionscode' => 'forumselect',
            'disporder' => 2
        ),
        'discord_integration_new_thread_groups' => array(
            'title' => 'New Thread User Groups',
            'description' => 'Sends a Discord message when a new thread is posted by the specified user groups.',
            'optionscode' => 'groupselect',
            'disporder' => 3
        ),
        'discord_integration_new_thread_default_nickname' => array(
            'title' => "Use webhook default nickname for new threads?",
            'description' => "If no, you can specify a custom name below or default to the acting username.",
            'description' => "If no, you can specify a custom name below or default to the acting username.",
            'optionscode' => 'yesno',
        		'value' => 0,
            'disporder' => 4
        ),
        'discord_integration_new_thread_nickname' => array(
            'title' => 'New Thread Discord Nickname',
            'description' => "If above is no, enter a custom nickname or leave blank to use acting username.",
            'optionscode' => 'text',
            'value' => '',
            'disporder' => 5
        ),
        'discord_integration_new_thread_message' => array(
            'title' => 'New Thread Discord Message',
            'description' => 'Message to send the Discord channel when a new thread is posted. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Variables">Discord Integration Variables</a> for variables you can use. Message can use <a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline">markdown</a>.',
            'optionscode' => 'textarea',
            'value' => '[{$mybb->user["username"]}]($userurl) created the thread [{$mybb->input["subject"]}]($threadurl) in [{$forum["name"]}]($forumurl).',
            'disporder' => 6
        ),
        'discord_integration_new_reply_webhook' => array(
            'title' => 'New Reply Webhook',
            'description' => 'Webhook for the channel that new reply notifications will be posted in. Leave blank to disable. See <a href="https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks">Intro to Webhooks</a> to learn how to find the webhook for your channel.',
            'optionscode' => 'text',
            'disporder' => 7
        ),
        'discord_integration_new_reply_forums' => array(
            'title' => 'New Reply Forums',
            'description' => 'Sends a Discord message when a new reply is posted in the specified forums.',
            'optionscode' => 'forumselect',
            'disporder' => 8
        ),
        'discord_integration_new_reply_groups' => array(
            'title' => 'New Reply User Groups',
            'description' => 'Sends a Discord message when a new reply is posted by the specified user groups.',
            'optionscode' => 'groupselect',
            'disporder' => 9
        ),
        'discord_integration_new_reply_default_nickname' => array(
            'title' => "Use webhook default nickname for new replies?",
            'description' => "If no, you can specify a custom name below or default to the acting username.",
            'optionscode' => 'yesno',
        		'value' => 0,
            'disporder' => 10
        ),
        'discord_integration_new_reply_nickname' => array(
            'title' => 'New Reply Discord Nickname',
            'description' => "If above is no, enter a custom nickname or leave blank to use acting username.",
            'optionscode' => 'text',
            'value' => '',
            'disporder' => 12
        ),
        'discord_integration_new_reply_message' => array(
            'title' => 'New Reply Discord Message',
            'description' => 'Message to send the Discord channel when a new reply is posted. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Variables">Discord Integration Variables</a> for variables you can use. Message can use <a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline">markdown</a>.',
            'optionscode' => 'textarea',
            'value' => '[{$mybb->user["username"]}]($userurl) posted in [{$mybb->input["subject"]}]($threadurl):\n\n$messageshort',
            'disporder' => 13
        ),
        'discord_integration_additional' => array(
            'title' => 'Additional Webhooks',
            'description' => 'Send messages for more specific behavior, e.g. when a staff member posts in your announcements board. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Additional-Behavior-Instructions">Additional Behavior Instructions</a> for further information.',
            'optionscode' => 'textarea',
			'value' => '-webhook=this_is_a_webhook\n-behavior=new_reply\n-forums=1,2,3\n-groups=1\n-prefixes=0\n-message=[{$mybb->user["username"]}](\$userurl) posted an announcement [{$mybb->input["subject"]}](\$threadurl)!\n---\n-webhook=this_is_another_webhook\n-behavior=new_thread\n-forums=4\n-groups=2,3,4\n-prefixes=1\n-message=\[$mybb->user["username"]](\$userurl) posted an open thread [\{$mybb->input["subject"]}](\$threadurl).',
            'disporder' => 14
        )
    );

    foreach($setting_array as $name => $setting)
    {
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

	return $allowed;
}

function build_request($behavior, $nickname=NULL, $content=NULL) {
	global $cache, $tid, $pid, $mybb, $forum;

	$prefix = $cache->read("threadprefixes")[$mybb->input['threadprefix']]['prefix'];

	$SHORT_POST_LENGTH = 200;

	if (!$content) $content = $mybb->settings['discord_integration_'.$behavior.'_message'];

	$userurl = "{$mybb->settings['bburl']}/member.php?action=profile&uid={$mybb->user['uid']}";
	$threadurl = "{$mybb->settings['bburl']}/showthread.php?tid={$tid}&pid={$pid}#pid{$pid}";
	$forumurl = "{$mybb->settings['bburl']}/forumdisplay.php?fid={$forum['fid']}";

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
