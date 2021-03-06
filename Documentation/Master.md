# Malley Web Tools Documentation



## Blueprint









------

## Inventory Count Receipt Tool

### Creating a Count  (Admin)

1. Open the file script_to_populate_new_inventory_count.sql
2. Process beings by creating an 'Inventory Count' to hold everything. Change the text on line 20 to give it a reflective name. Line 21 can be used to identify the creator.
   <img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107112549588.png" alt="image-20220107112549588" style="zoom:50%;" />
3. The second step involves creating references for each stock code @ bin location reference. Use the WHERE block at line 73 to 77 to filter.
   ![image-20220107112832983](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107112832983.png)
4. Run the script. A cursor is created to handle each row. Depending on the number of items to be counted, this can take a few seconds. 
5. The count will now be visible at the top of the table on
   https://index.malleyindustries.com/syspro/inventory
   <img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107113153933.png" alt="image-20220107113153933" style="zoom: 33%;" />
6. Open the count.
7. Confirm the process ran as expected. Did the right bins and sections get created?
8. When you are satisfied that the count is what you want, click on the **Update Cache** link at the bottom of the right-hand list on the home page. This will go through each item in the count and calculate where each ticket appears in sequence. This makes Next and Previous buttons work and **vastly** speeds up the count take process

The count is now ready to begin.

**NOTE ON CACHING:** When a ticket count is entered, the system will automatically recalculate the next and previous tickets in sequence. Also, the home page results are cached and only regenerated every 10 minutes to speed up loading. 



### Printing Tickets

Navigate to the report, bin, stock code, locale etc. that you wish to produce tickets for and click **Generate Tickets** at the top of the page. 

Clicking **Generate Tickets Grouped By Bins** produces the same results, except pads the groups with blank tickets to be more easily separated.

Either way, a PDF of the requested tickets will be generated which is ready to be printed. 

**It is VERY important** to make sure that when printing, that the printer is set to not scale the file. This is worded differently depending on manufacturer, but will look like **Scale: none / Actual Size / Zoom 0%** or some other variation. Make sure to test a single sheet printed on sticker paper to ensure that the tickets line up with the perforations.

Ticket sheet dimensions for ordering: Letter-size (8.5" x 11") paper, top and bottom margin 0.25". Body divided into three equal columns of 2.8333" and 7 equal rows of 1.5". Sticker paper stock - reusable sticker adhesive preferable so that the stubs are easier to remove. 

Tickets are divded into a two-column-wide body and a 1-column stub which is stuck on the bin.



### Finding What You Need

The top of every page includes search boxes to help you navigate around a count. Simply type in all or part of the thing you are looking for into the appropriate box and you will be brought to the matching results. 

![image-20220107115736569](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107115736569.png)

Each ticket contains information to help you quickly look up what youneed.

![image-20220107115652282](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107115652282.png)

**#0001R** is the ticket number. The **R** at the end indicates that this is a recount ticket.

**AREA: MEZZ** indicates that the item to be counted is located in the Mezzanine area upstairs. In the count tool, AREA and LOCALE mean the same thing. 

**BIN: MZ02A** is the specific bin location.

**PART: 55-11375** is the Malley stock code number

The fastest way to find this item is by the Ticket Number. In the top right corner of the screen, you'll find the Ticket Number search box: <img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107120448707.png" alt="image-20220107120448707" style="zoom:50%;" /> Simply enter 1 or 0001 into the box<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107120419940.png" alt="image-20220107120419940" style="zoom:50%;" /> and click Search. You will be taken directly to the ticket count page. 

Searching by the other fields involves more filtering. For example, Part 55-11375 might be located in multiple bins. If you search by Stock Code, you will be presented with a list of all bin locations where that part is located. **Make sure you pick the right bin or ticket number!**

Searching for a Bin Locaiton works the same way. Entering **MZ18C** into the **Bin Search** box and clicking **Search** will show you a list of all items located at that bin.

![image-20220107120933968](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107120933968.png)



### Receiving a Count

As the count proceeds, tickets will come back for entry. The easiest way to receive the tickets is to enter the ticket number in the **Ticket Number** field at the top right of the page. Refer to the **Finding What You Need** section on how to get around.

#### The Stock Take screen

![image-20220107131515690](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107131515690.png)

The top of the page matches what you see on a ticket. **Ticket Number**, Location, Bin, and **Part Number**.

You will also see an indicator at the top of the page what the status of a particular ticket is. This could be:

- **Not Counted** - the ticket has not been counted yet
- **Matched** - the ticket has been counted and the correct amount was found
- **Needs Recount** - the ticket was counted but needs to be recounted because it doesn't correspond to what was expected
- **Accepted** - the count does not match the expected value but has been accepted as correct.

The table on the left shows more identifying information which may be helpful.

The Count History table shows the count or counts that have been taken for this ticket so far. Only the most recent count is valid. 

#### Entering a Count

To enter a count, simply fill in the quantity on the ticket and if known, the name of the counter. If the counter's name isn't known, this can be left blank. The page will remember the last used name so you only need to change it if it's different. 

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220107132142441.png" alt="image-20220107132142441" style="zoom:50%;" />

You can submit this by either hitting **Enter** on your keyboard or by clicking **Save Count**.

If you make a mistake, such as mistyping or entering the wrong number, just enter the correct number and submit it. Only the most recent values entered matter.

When you submit the count, the page will reload. The status at the top of the page will change depending on whether the value you entered matched what was expected. You are now done with this ticket and ready to move on. 

#### Navigating using the keyboard

The tool has been designed to make it as fast as possible to enter counts. When you open a Stock Take page, the quantity field will already be selected and ready for you to type into. 

Hitting **ENTER** at any time will submit the count you have entered

Clicing the **+** **(plus) key** will take you to the next ticket expecting input. Clicking **the - (minus) key** will take you to the previous ticket expecting input. 

**The + and - keys will skip over tickets that have already been counted and matched.** 

#### Custom Ticket Entry

The count sheets include blank tickets for when a counter finds an item in their area that they were not expecting to find. On most pages you'll find a button: <img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220126150755215.png" alt="image-20220126150755215" style="zoom:50%;" /> which when pressed will open a form to enter this data. There is also a link to enter in a new blank ticket from the count home page.

![image-20220126150929202](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/image-20220126150929202.png)

Fill in as much information as you can from the ticket provided. When you click the Save and Continue button, you'll be taken to the Stock Take Screen when the quantity found will be entered. 



------

## Option Index





------

## Inventory & Purchasing Tools



### Part Order Requests

This tool is intended to make it easier to let us know if a part is needed, and what it's for. You can find everything to do with purchase requests under the Inventory Menu at the top of the Malley Internal Home Page. If you don't have access to that, ask Myles or Kayla for help. 



#### Creating a New Request

Head over to https://index.malleyindustries.com/syspro/purchasing/newRequest

You will be presented with a Request Form. Please fill in as much information as you possibly can, especially if you are requesting a non-stock or new part. 

![Screenshot from 2021-09-24 15-48-30](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-09-24 15-48-30.png)

If you know the part number, you can start typing it into the Part Number field. As you type, a list of possible  matches will appear. Clicking on a match will fill out most of the form for you.

#### Checking on Open Requests



#### Seeing Open Requests by Department



#### Seeing Recent Deliveries



------

## Vehicle Database



------

## Labour Tracking



### For Staff



#### Overview

This is a simple tool for keeping track of the labour done on the jobs we do. All this tool tracks is who works on what and for how long.



#### Logging In

An account will be created for you, including a password. You can change your password to something memorable whenever you want. 

The computers on the shop floor will show the login screen automatically. If you do not see it, follow the links for Labour, or go to https://index.malleyindustries.com/labour

The first thing you will see is this:

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 12-40-32.png)

Choose the first letter of your last name.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 12-42-07.png)

Choose your name from the list by clicking on it. At any time, if you need to go back, you can click the button in the top right.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 12-43-15.png)

Enter your password. If this is your first time, you will have been given a temporary one. If you have forgotten your password or are having trouble signing in, let your supervisor know to have it reset. 



#### Logging Out

At any time, you can log out by clicking on the **Log Out** button at the top right corner of the screen.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 12-47-21.png)

As a courtesy to other staff, you should always **Log Out** after you are finished clocking in or out.



#### Clocking In

To clock in to a job, select it from the **Choose A Job** list you see when you first clock in. The different tabs are the prefixes that are used to categorize jobs. The **RECENT** tab shows the last 10 or so jobs that you have clocked in on if they are still open.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/.png)

The **SEARCH** tab can be used to find jobs if you don't want to filter through a long list. Start typing in the job number and the best matches will be shown.  

When you have found the job you want, click on the large yellow **Start on JOB####** button next to the job number and description. 

If you are done, make sure you **Log Out**.



#### Clocking Out

If you are finished working or are done on a job and ready to work on another one, log in as before. You will see a green box that looks like this:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-45-46.png" style="zoom:50%;" />

Click the **Clock out of ######** button at the top right of the screen. You will then be able to **Log Out** or **Clock In** to a different job.



### For Supervisors / Management

#### Reviewing Staff Tme

To look up labour for a person, department or particular day, click on the **Labour** menu at the top of your screen, and then click on the **See and Make Changes To Labour** link.

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-50-08.png" style="zoom: 50%;" />

From here, you will be presented with a box with different options.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-52-43.png)

The reports filter based on the inputs given. All Staff returns work on a single date. By Department filters by department for a single date. By Person and Dates takes an individual and returns their labour between a start and end date. 

When you have, for example, selected a date to look up and hit **Go**, the screen will update with all matching results. The results are presented in the form of a person's daily Time Card.

Somone who has booked labour on a day will look something like this:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-56-27.png" style="zoom: 50%;" />

A day with no labour on it looks like this:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-56-48.png" alt="Screenshot from 2021-12-14 13-56-48" style="zoom: 50%;" />



#### Add New Time

If a person has forgotten to clock on to a job, you can add time to their time card. Find the correct person and date using one of the options provided:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 13-52-43.png" style="zoom:33%;" />

In the top-right corner of the time card in question, click the green **Add** button. A new green form will appear to the right hand side of the time card you are editing.  **The time card you are working with will also change colour to be easier to see**.

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 14-04-34.png" style="zoom: 33%;" />

Fill in the green **Add Labour to [NAME] on [DATE]** form fields. They are all required. 

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-14 14-06-10.png" style="zoom:50%;" />

The box at the bottom of the form will let you choose the job they are working on. The **RECENT** tab shows the last few jobs that person has been clocked in to that are still open in Syspro. the **SEARCH** tab allows you to find the right one you are looking for.

When you are done, click on the **Add Labour** button. If there are no errors to be fixed, the time is added and the person's time card is updated.

If there are errors, you will be prompted to fix them before you can add the time. 

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-10-00.png" style="zoom:33%;" />

You can cancel this at any time before saving changes. If you leave the page or go to make changes on another record before saving this new labour though, it will be lost.



#### Edit an Existing Record

NOTE 1: You can only make changes to labour records if they haven't been posted to Syspro already. 

NOTE 2: You can make changes to a labour record when they are clocked out. If they are not clocked out yet, this must be done first. See **Clock Someone Out**.

Click on a record on a time card. A dark blue window will appear on the right side of your screen. You can change any details about the record you wish, including the job.

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-07-53.png" style="zoom:50%;" />



When you have finished, click the blue Save Changes to Labour button. You can cancel this at any time as well.



#### Delete Time

Note: Once a labour record is deleted, it can't be brought back. 

You can delete a record entirely if it was added in error.  Follow the steps to edit the record but instead of making changes, click the red Delete Labour button at the bottom of the blue box. 

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-08-15.png" style="zoom:50%;" />



#### Clock Someone Out

If someone is currently clocked in, their time card will look something like this:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-08-57.png" style="zoom: 67%;" />

If you click on the **ongoing** record, a light blue box on the right will appear that will allow you to manually clock that person off the job they are working on.

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-09-18.png" style="zoom:50%;" />





### Managing Production Staff Accounts

This section explains the steps to manage staff accounts. Everything herein can be reached from the **Admin** menu at the top of the page. If you don't see the **Admin** menu but you should, let Myles or Kayla know to update your account.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-34-33.png)



#### See All Staff Accounts

From the **Admin Menu** click on **See All**. You will be presented with a list of all existing staff accounts. 

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-34-53.png)

The name, department, account status and other options are listed for each person. Employee accounts are never deleted, even if they no longer work with us to maintain records. However, their account status shows whether or not they can log in or not. An account listed as **LOCKED** does not appear in the login menu.



#### Add New Production Staff

To add a new staff account, click on the **Add Staff** button from the list of **All Staff**, or click on the **Add New Production Staff** link in the **Admin Menu**.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-35-02.png)

You will be presented with a simple form that requires very little information.

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-37-44.png" style="zoom:50%;" />

All fields are required.

The **Password** field will be pre-filled with a introductory password in the format of **Welcome[random number]**. This pre-filled password will be different every time, so please make note of it. You can also substitute that for a different one if you prefer. 

As soon as you click **Create Account** the person will be able to sign in using the password you provided. 



#### Lock Out Production Staff

When someone is no longer with the company, their account needs to be locked to prevent them from signing in. To do so, find the person in the **All Staff** list and click on the **Edit** button.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-35-29.png)

At the bottom of the page, you'll see a red **LOCK ACCOUNT** button. Clicking it will disable their ability to log in.

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-36-51.png)

If a mistake was made, or that employee rejoins the company, their account can be re-enabled by following the same process as locking their account. However this time, the form will look like this:

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-37-03.png)



#### Reset Someone's Password

If someone has forgotten their password, find them in the **All Staff** list and click the **Reset Password** link next to their name. 

![](/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-35-29.png)

You will be presented with a form that looks like this:

<img src="/home/myles/Dropbox/PhpstormProjects/Malley/Documentation/Master.assets/Screenshot from 2021-12-22 10-36-20.png" style="zoom: 50%;" />

NOTE 1: The passord you use is **case sensitive** and has to be at least six characters long. For exmaple, **pass11** and **Pass11** are not the same thing. There are no other rules or requirements. The user's password can be any combination of letters, numbers and symbols. In this situaiton, they do not need to be strong - just memorable. 

NOTE 2: There is no way to recover a forgotten password. The only way to regain access is to reset it to something new. 



****

## Administration



------

## Setup & Troubleshooting



