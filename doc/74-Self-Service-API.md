<a id="Self-Service-API"></a>Self Service API
=============================================

Introduction
------------

Icinga Director offers a Self Service API, allowing new Hosts running the Icinga
Agent to register themselves in a secure way.

### Windows Agents

Windows Agents are the main target audience for this feature. It allows you to
generate a single Powershell Script based on the [Icinga 2 Powershell Module](
https://github.com/Icinga/icinga2-powershell-module
). You can either use the same script for all of your Windows Hosts or generate
different ones for different kind of systems.

This installation script could then be shipped with your base images, invoked
remotely via **PowerShell Remoting**, distributed as a module via **Group
Policies** and/or triggered via **Run-Once** (AD Policies).

### Linux Agents

At the time of this writing, we do not ship a script with all the functionality
you can find in the Windows Powershell script. Linux and Unix environments are
mostly highly automated these days, and such a magic shell script is often not
what people want.

Still, you can also benefit from this feature by directly using our [Self Service
REST API](70-REST-API.md). It should be easy to integrate it into
the automation tool of your choice.

Base Configuration
------------------

You have full control over the automation Script generated by the Icinga Director.
Please got to the **Infrastructure Dashboard** and choose the **Self Service API**:

![Infrastructure Dashboard - Self Service API](screenshot/director/74_self-service-api/7401-director_self-service-dashboard.png)

This leads to the Self Service API Settings form. Most settings are self-explaining
and come with detailled inline hints. The most important choice is whether the
script should automatically install the Icinga Agent:

![Settings - Choose installation source](screenshot/director/74_self-service-api/7402-director_self-service-choose-source.png)

In case you opted for automated installation, more options will pop up:

![Settings - Installer Details](screenshot/director/74_self-service-api/7403-director_self-service-settings.png)