<?php

            $DEFCFG->config['sitename']->name = ("Site name");
            $DEFCFG->config['sitename']->description = ("Name of the site (eg Elgg, Apcala, University of Bogton's Social Network, etc)");
            $DEFCFG->config['tagline']->name = ("Tagline");
            $DEFCFG->config['tagline']->description = ("A tagline for your site (eg 'Social network for Bogton')");
            $DEFCFG->config['wwwroot']->name = ("Web root");
            $DEFCFG->config['wwwroot']->description = ("External URL to the site (eg http://elgg.bogton.edu/). NB: **MUST** have a final slash at the end");
            $DEFCFG->config['dirroot']->name = ("Elgg install root");
            $DEFCFG->config['dirroot']->description = ("Physical path to the files (eg /home/elggserver/httpdocs/). NB: **MUST** have a final slash at the end");
            $DEFCFG->config['dataroot']->name = ("Elgg data root");
            $DEFCFG->config['dataroot']->description = ("This is where uploaded files will go (and sessions for now). If possible, this should live outside your dirroot; **MUST** have a final slash at the end");
            $DEFCFG->config['sysadminemail']->name = ("System administrator email");
            $DEFCFG->config['sysadminemail']->description = ("The email address your site will send email from (eg elgg-admin@bogton.edu)");
            $DEFCFG->config['newsinitialpassword']->name = ("News account initial password");
            $DEFCFG->config['newsinitialpassword']->description = ("The initial password for the 'news' account. This will be the first administrator user within your system, and you should change the password immediately after the first time you log in");
            $DEFCFG->config['defaultlocale']->name = ("Default locale");
            $DEFCFG->config['defaultlocale']->description = ("Country code to set language to if you have gettext installed");
            $DEFCFG->config['publicreg']->name = ("Public registration");
            $DEFCFG->config['publicreg']->description = ("Can general members of the public register for this system?");
            $DEFCFG->config['publicreg']->type = "boolean";
            $DEFCFG->config['publicinvite']->name = ("Public invitations");
            $DEFCFG->config['publicinvite']->description = ("Can users of this system invite other users in?");
            $DEFCFG->config['publicinvite']->type = "boolean";
            $DEFCFG->config['maxusers']->name = ("Maximum users");
            $DEFCFG->config['maxusers']->description = ("The maximum number of users in your system. If you set this to 0, you will have an unlimited number of users");
            $DEFCFG->config['maxusers']->type = "integer";
            $DEFCFG->config['maxspace']->name = ("Maximum disk space");
            $DEFCFG->config['maxspace']->description = ("The maximum disk space taken up by all uploaded files");
            $DEFCFG->config['maxspace']->type = "integer";
            $DEFCFG->config['walledgarden']->name = ("Walled garden");
            $DEFCFG->config['walledgarden']->description = ("If your site is a walled garden, nobody can see anything from the outside. This will also mean that RSS feeds won't work");
            $DEFCFG->config['walledgarden']->type = "boolean";
            $DEFCFG->config['emailfilter']->name = ("Email filter");
            $DEFCFG->config['emailfilter']->description = ("Anything you enter here must be present in the email address of anyone who registers; e.g. @mycompany.com will only allow email address from mycompany.com to register");
            $DEFCFG->config['default_access']->name = ("Default access");
            $DEFCFG->config['default_access']->description = ("The default access level for all new items in the system");
            $DEFCFG->config['default_access']->type = ("access");
            $DEFCFG->config['disable_usertemplates']->name = ("Disable user templates");
            $DEFCFG->config['disable_usertemplates']->description = ("If this is set, users can only choose from available templates rather than defining their own");
            $DEFCFG->config['disable_usertemplates']->type = "boolean";
            $DEFCFG->config['disable_templatechanging']->name = ("Disable template changing");
            $DEFCFG->config['disable_templatechanging']->description = ("Users cannot change their template at all");
            $DEFCFG->config['disable_templatechanging']->type = "boolean";
            $DEFCFG->config['dbtype']->name = ("Database type");
            $DEFCFG->config['dbtype']->description = ("Acceptable values are 'mysql' and 'postgres' - MySQL is highly recommended");
            $DEFCFG->config['dbname']->name = ("Database name");
            $DEFCFG->config['dbhost']->name = ("Database host");
            $DEFCFG->config['dbuser']->name = ("Database user");
            $DEFCFG->config['dbpass']->name = ("Database password");
            $DEFCFG->config['prefix']->name = ("Database table prefix");
            $DEFCFG->config['prefix']->description = ("All database tables will start with this; we recommend 'elgg'");
            $DEFCFG->config['dbpersist']->name = ("Persistent connections");
            $DEFCFG->config['dbpersist']->description = ("Should Elgg use persistent database connections?");
            $DEFCFG->config['dbpersist']->type = "boolean";
            $DEFCFG->config['debug']->name = ("Debug");
            $DEFCFG->config['debug']->description = ("Set this to 2047 to get adodb error handling");
            $DEFCFG->config['debug']->type = "integer";
            $DEFCFG->config['rsspostsmaxage']->name = ("RSS posts maximum age");
            $DEFCFG->config['rsspostsmaxage']->description = ("Number of days to keep incoming RSS feed entries for before deleting them");
            $DEFCFG->config['rsspostsmaxage']->type = "integer";
            $DEFCFG->config['adminuser']->name = ("Admin username");
            $DEFCFG->config['adminuser']->description = ("Username to log into this admin panel");
            $DEFCFG->config['adminuser']->type = "requiredstring";
            $DEFCFG->config['adminpassword']->name = ("Admin password");
            $DEFCFG->config['adminpassword']->description = ("Password to log into this admin panel");
            $DEFCFG->config['adminpassword']->type = "requiredstring";
            $DEFCFG->config['templatesroot']->name = ("Templates location");
            $DEFCFG->config['templatesroot']->description = ("The location of your Default_Template directory");
            
?>