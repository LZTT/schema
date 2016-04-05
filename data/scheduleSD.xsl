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
        <!-- setting up html sheet and table -->
        <html>
            <head>
                <title>Timetable</title>
            </head>
            <body>
                <h2>Day as Heading</h2>
                <table>
                    <!-- adding 2 templates for header and content-->
                    <xsl:call-template name="top-day"/>
                    <xsl:apply-templates select="schedule/by_time/book_time"/>
                </table>
            </body>
        </html>
    </xsl:template>
    <!-- header -->
    <xsl:template name="top-day">
        <tr>
            <th>Time\Day</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
    </xsl:template>
    <!-- content -->
    <xsl:template match="book_time">
        <tr>
            <td>
                <!-- filling in the time column -->
                <xsl:value-of select="@time"/>
            </td>
            <!-- filtering data by each of the day-->
            <td>
                <xsl:apply-templates select="week_day[@day='Monday']"/>
            </td>
            <td>
                <xsl:apply-templates select="week_day[@day='Tuesday']"/>
            </td>
            <td>
                <xsl:apply-templates select="week_day[@day='Wednesday']"/>
            </td>
            <td>
                <xsl:apply-templates select="week_day[@day='Thursday']"/>
            </td>
            <td>
                <xsl:apply-templates select="week_day[@day='Friday']"/>
            </td>
        </tr>
    </xsl:template>
    
    <!-- template for course detail -->
    <xsl:template match="week_day">
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
