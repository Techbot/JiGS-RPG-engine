# Kodaly - A command line application to run a group of Joomla CMS plugins.

Zoltán Kodály is known for his *Háry János Suite*, the second movement of which is entitled "Vienese Musical Clock". **Kodlay** is a very simple skeleton for a command line application that might be configured to run as a CRON task. It loads a folder of Joomla plugins. It demonstrates:

* how to add database support in a command line application;
* how to identify command line switches and variables; and
* how to interact with a Joomla CMS.

## Overview

<dl>
  <dt>bin/</dt>
  <dd>This folder contains the executatable files.</dd>
  <dt>code/</dt>
  <dd>This folder contains all the custom application code.</dd>
  <dt>config/</dt>
  <dd>This folder contains the configuration file for the application.</dd>
</dl>

Note that within the ``code/`` folder, all the classes are prefixed with "Kodaly" and then all the classes follow the auto-loader naming convention. The prefix is specified in the last line of the ``code/bootstrap.php`` file:

<pre>// Setup the autoloader for the Kodaly application classes.
JLoader::registerPrefix('Kodaly', __DIR__);</pre>

You can search-and-replace the word "Kodaly" and replace it with your own application name. You can also search-and-replace "{COPYRIGHT}".

This type of architecture could be used to support a single command-line application, or it could be used for many different variants, each with its own executable in ``bin/``, but using a common code library under ``code/``.

## Requirements

* PHP 5.3+

## Installation

This application assumes that you have cloned it and the Joomla Platform into a folder called "joomla" under the same parent. For example:

<pre>/parent
../Kodaly    &lt;-- this repository
../joomla  &lt;-- the Joomla platform</pre>

The simplest way to do this is like this:

<pre>mkdir Composers
cd Composers
git clone git://github.com/joomla/joomla-platform.git joomla
git clone git://github.com/eddieajau/jc-Kodaly.git Kodaly</pre>

Such a setup will allow the application to auto-discover the Joomla Platform. Alternatively, you can configure some environment variables so that your applications know where to find the Joomla Platform (probably the way you would do it on the production server).

<pre>JPLATFORM_HOME=/path/to/joomla/platform</pre>

Once you have cloned this repository, you can then push it to one your have created for your own application.

In addition, copy the ``config/config.dist.json`` file to ``config.json`` and adjust the database connection variables.

## Running the application

To run the application, navigation to the "/bin" folder and make sure the "run" file is executable. Then run it directly (if on a *nix operating system).

By default, the plugins in the "cron" group will be executed if enabled, or another group can be specified using the "-g" or "--group" switch. The path to the head of the Joomla CMS must be included so that the application can find the plugins files.

Consult your operating system requirements for putting the script in your execution path so that you can run it from any folder.

## About the Joomla Composers

The Joomla Composers are a suite of skeleton git repositories that can be used to kick-start your own Joomla Platform Projects. You can clone any of the repositories as a base for building your own application, or cherry-pick what you need.