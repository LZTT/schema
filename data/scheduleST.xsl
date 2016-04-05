<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : scheduleST.xsl
    Created on : March 31, 2016, 2:06 PM
    Author     : Rin
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet version="1.1" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        
        <html>
            <head>
                <title>Timetable</title>
            </head>
            <body>
                <h2>Time as Heading</h2>
                <table>
                    <xsl:call-template name="top-time"/>
                    <xsl:apply-templates select="schedule/by_day/book_day"/>
                </table>
            </body>
        </html>
    </xsl:template>
    <!-- creating a list of time to fill the top-->
    <xsl:template name="top-time">
        <tr>
            <th>Day\Time</th>
            <th>08:30</th>
            <th>09:30</th>
            <th>10:30</th>
            <th>11:30</th>
            <th>12:30</th>
            <th>13:30</th>
            <th>14:30</th>
            <th>15:30</th>
            <th>16:30</th>
        </tr>
    </xsl:template>
    <!-- seperate by day -->
    <xsl:template match="book_day">
        <tr>
            <td>
                <xsl:value-of select="@day"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='0830']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='0930']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1030']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1130']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1230']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1330']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1430']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1530']"/>
            </td>
            <td>
                <xsl:apply-templates select="class_time[@time='1630']"/>
            </td>
        </tr>
    </xsl:template>
    
    <xsl:template match="class_time">
        <xsl:value-of select="course/@number" />
        <br />
        <xsl:value-of select="detail/@instructor" />
        <br />
        <xsl:value-of select="detail/@room" />
        <br />
        <xsl:value-of select="detail/@type" />
        <xsl:value-of select="detail/@dur" />
    </xsl:template>
</xsl:stylesheet>
