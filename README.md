# Discord Integration
Automatically send messages to your Discord channels when a user does something!

## Live Preview
* [Forum](http://www.plugins.shinkarpg.a2hosted.com/showthread.php?tid=23)
* [Discord server](https://discord.gg/NbBQNHv)

## Additional Instructions
* See [Additional Behavior Instructions](https://github.com/kalynrobinson/discord_integration/wiki/Additional-Behavior-Instructions) to learn how to make more specific triggers.
* See [Variables](https://github.com/kalynrobinson/discord_integration/wiki/Variables) for a list of variables you can use in your messages.

## Features
* Send Discord messages based on the following behaviors:
  * User posts a new thread in specific forums
  * User replies to a thread in specific forums
  * New user signs up
  * A new thread is posted with a specific prefix
* Choose which forums and usergroups you want to be eligible for integration
* Choose which Discord channel to send a message based on the behavior
* Define your own messages with useful variables based on the behavior
* Configure the display name of the Discord message

## Use Cases
* Send a message to your #member-introductions channel when a user starts a thread in your introductions board!
* Send a message to your #open-threads channel when a user posts starts a thread the Open prefix!
* Send a message to your #tagboard channel when a user replies to a thread in your roleplaying forums!

## Installation
* Simply copy inc/plugins/discord_integration.php to your site's inc/plugins folder.
* Then install and activate the plugin via your Admin CP.
* Configure the settings to your desire via Admin CP > Configuration > Discord Integration Settings.

## Technical
* Uses Discord's webhooks to POST new messages.
