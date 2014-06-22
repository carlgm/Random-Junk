#!/bin/bash

# Quick script written to make sure Redshift is working as expected, run on login.
# Get LAT and LONG for your area from a site like: http://www.latlong.net/convert-address-to-lat-long.html

LAT=""
LONG=""


if [ ! -f '/usr/bin/redshift' ]
then
	notify-send -a xflux "xflux is not installed"
fi

if [ `pgrep -xc 'redshift'` -eq 0 ]
then
	notify-send -a redshift "redshift not detected, starting now."
	redshift -l $LAT:LONG -o
else
	notify-send -a redshift "redshift already running"
fi
