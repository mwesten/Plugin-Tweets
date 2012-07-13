Plugin-Tweets
=============

Tweets sidebar plugin for Statamic

# Installation
## Clone or Copy the files to their destination
Clone this project on your system:

    cd webfolder/_add-ons
    git clone git://github.com/mwesten/Plugin-Tweets.git tweets

Or download the project and add the contents of archive to the `_add-ons/tweets` folder.

## Configure twitter
Make sure you set the `twitter_name:` to your twitter name in the `_config/globals.yaml`

## Add the tweets to your sidebar
Open the file `_themes/london-wild/partials/sidebar.html`
Add the following block:

    <div class="block">
      <h6>Tweets</h6>
      {{ tweets:tweets name="{{twitter_name}}" count="4"}}
    </div>

This displays the 4 latest tweets for the configured twitter name.

# calling
Calling the plugin from the theme is done with `{{ tweets:tweets }}`.

It has the following parameters:

 Parameter 	| Default	| Function
 -----------|--------	| --------
 `name` 	| *empty* 	| This is someone's twitter name; everything that's after the `@` sign.
 `count` 	| *10* 		| The number of tweets that you'd like to display.
 `show_replies` 	| *no*	| If replies to other users need to be included in this list.
 `show_retweets` | *yes*	| If retweets done by this user need to be included in this list.


**Examples:**

Show the 4 latest tweets by @statamic with replies and retweets: `{{ tweets:tweets name="statamic" count="4" show_replies="yes"}}`

Show the 10 latest tweets by @statamic without replies and retweets: `{{ tweets:tweets name="statamic" show_retweets="no"}}`

#Styling

If you want to override the default styling, copy the `_add-ons/tweets/css/pi.tweets.css` file to your themes `css` folder; ie: `_themes/london-wild/css/pi.tweets.css`. Then change the css file in your theme folder; this takes precedence.


# Disclaimer
I've 'written' this plugin for my own use. It comes without any guarantee, so your mileage may vary in using it. If you find bugs or have great additions you'd like to share, use github to fork the project and share your improvements by initiating pull requests.
