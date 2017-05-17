<?php
/**
 * Discord Integration
 * Author: Shinka
 * Copyright 2017 Shinka, All Rights Reserved
 *
 * License: http://www.mybb.com/about/license
 *
 */

$l['discord_integration_name'] = 'Discord Integration';
$l['discord_integration_desc'] = 'Automatically send messages to your Discord channels when a user does something!';
$l['discord_integration_settings_title'] = 'Discord Integration Settings';
$l['discord_integration_settings_desc'] = 'Automatically send messages to your Discord channels when a user does something!';

$l['discord_integration_new_thread_webhook_title'] = 'New Thread Webhook';
$l['discord_integration_new_thread_webhook_desc'] = 'Webhook for the channel that new thread notifications will be posted in. Leave blank to disable. See <a href="https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks">Intro to Webhooks</a> to learn how to find the webhook for your channel.';
$l['discord_integration_new_thread_forums_title'] = 'New Thread Forums';
$l['discord_integration_new_thread_forums_desc'] = 'Sends a Discord message when a new thread is posted in the specified forums.';
$l['discord_integration_new_thread_groups_title'] = 'New Thread User Groups';
$l['discord_integration_new_thread_groups_desc'] = 'Sends a Discord message when a new thread is posted by the specified user groups.';
$l['discord_integration_new_thread_users_title'] = 'New Thread Users';
$l['discord_integration_new_thread_users_desc'] = 'Comma-separated list of user IDs. Sends a Discord message when a thread is posted by one of these users. Leave blank for all users.';
$l['discord_integration_new_thread_default_nickname_title'] = 'Use webhook default nickname for new threads?';
$l['discord_integration_new_thread_default_nickname_desc'] = 'If no, you can specify a custom name below or default to the acting username.';
$l['discord_integration_new_thread_nickname_title'] = 'New Thread Discord Nickname';
$l['discord_integration_new_thread_nickname_desc'] = 'If above is no, enter a custom nickname or leave blank to use acting username.';
$l['discord_integration_new_thread_message_title'] = 'New Thread Discord Message';
$l['discord_integration_new_thread_message_desc'] = 'Message to send the Discord channel when a new thread is posted. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Variables">Discord Integration Variables</a> for variables you can use. Message can use <a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline">markdown</a>.';
$l['discord_integration_new_thread_message'] = '$userlink created the thread $threadlink in $forumlink.';

$l['discord_integration_new_reply_webhook_title'] = 'New Reply Webhook';
$l['discord_integration_new_reply_webhook_desc'] = 'Webhook for the channel that new reply notifications will be posted in. Leave blank to disable. See <a href="https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks">Intro to Webhooks</a> to learn how to find the webhook for your channel.';
$l['discord_integration_new_reply_forums_title'] = 'New Reply Forums';
$l['discord_integration_new_reply_forums_desc'] = 'Sends a Discord message when a new reply is posted in the specified forums.';
$l['discord_integration_new_reply_groups_title'] = 'New Reply User Groups';
$l['discord_integration_new_reply_groups_desc'] = 'Sends a Discord message when a new reply is posted by the specified user groups.';
$l['discord_integration_new_reply_users_title'] = 'New Reply Users';
$l['discord_integration_new_reply_users_desc'] = 'Comma-separated list of user IDs. Sends a Discord message when a thread is posted by one of these users. Leave blank for all users.';
$l['discord_integration_new_reply_default_nickname_title'] = 'Use webhook default nickname for new replies?';
$l['discord_integration_new_reply_default_nickname_desc'] = 'If no, you can specify a custom name below or default to the acting username.';
$l['discord_integration_new_reply_nickname_title'] = 'New Reply Discord Nickname';
$l['discord_integration_new_reply_nickname_desc'] = 'If above is no, enter a custom nickname or leave blank to use acting username.';
$l['discord_integration_new_reply_message_title'] = 'New Reply Discord Message';
$l['discord_integration_new_reply_message_desc'] = 'Message to send the Discord channel when a new reply is posted. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Variables">Discord Integration Variables</a> for variables you can use. Message can use <a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline">markdown</a>.';
$l['discord_integration_new_reply_message'] = '$userlink posted in $threadlink:\n\n$messageshort';

 $l['discord_integration_additional_title'] = 'Additional Webhooks';
 $l['discord_integration_additional_desc'] = 'Send messages for more specific behavior, e.g. when a staff member posts in your announcements board. See <a href="https://github.com/kalynrobinson/discord_integration/wiki/Additional-Behavior-Instructions">Additional Behavior Instructions</a> for further information.';
 $l['discord_integration_additional_value'] = '-webhook=this_is_a_webhook\n-behavior=new_reply\n-forums=1,2,3\n-groups=1\n-prefixes=0\n-message=\$userlink posted an announcement \$threadlink!\n---\n-webhook=this_is_another_webhook\n-behavior=new_thread\n-forums=4\n-groups=2,3,4\n-prefixes=1\n-message=\$userlink posted an open thread \$threadlink.';

 $l['discord_integration_content_error'] = "Sorry, there's something wrong with your message variables!";

 ?>