# Scene Capture (webCoRE & Action Tiles)

Scene Capture is a script using [webCoRE](http://webcore.co) pistons and php to capture your current SmartThings light setup and save it (no database needed) for later.
This tool was initially created to help my friends & clients play around with their lights and then be able to capture the current scene so I could later set it up for them without visiting their home.

*This tool supports multiple users in case you are helping more then 1 friend or client with their smart home lights.*

## SETING UP
1) Upload package to your web host

2) Create 2 new pistons in [webCoRE](http://webcore.co) using the follwoing backup codes

   **Get Scene:** v9uoe
   
   **Run Scene:** redy9
   
3) Inside the **Get Scene** piston, update `allDevices` variable to all the lights you would like to pull data from

   If you are this for multiple users *(webCoRE Instances)* you also need to update `userId` with a unique name/number *(no spaces or special characters)* for each Get Scene piston. If left blank userId 1 will be autmoaticlly used.

4) Open up `config.php` and enter the 2 pistons External URL's.
You can get them by opening each piston, right click on External URL link and select Copy Link.

   ```
   // webCoRE Run Scene Piston URL
   $webcoreUrlRun = "WEBCORE_RUN_URL_HERE";

   // webCoRE Get Scene Piston URL
   $webcoreUrlGet = "WEBCORE_GET_URL_HERE";
   ```
   
5) In [ActionTiles](http://actiontiles.com), create a new [shortcut](https://app.actiontiles.com/shortcuts) and point it to `https://YOUR_DOMAIN/create-scene.php`

6) Add the new shortcut tile to your panel and make sure you select **tile content** to `Open shortcut in a dialog within the Panel`
