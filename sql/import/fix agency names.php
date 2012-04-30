<?php

/*
Find all programs named "volunteer" and rename them as the agency's
 */

$import = "100 Black Men of Milledgeville Oconee Area
4H for Baldwin County
American Cancer Society
American Cancer Society
American Cancer Society
American Lung Assn Milledgeville
American Lung Assn Milledgeville
American Lung Assn Milledgeville
American Red Cross
Andalusia, Home of Flannery OConnor
Angel Food Ministries
Animal Rescue Foundation
Babies Cant Wait
Baldwin Bowling Center
Baldwin Bulletin
Baldwin Charter School
Baldwin County Chamber of Commerce
Baldwin High School
Baldwin High School
Baldwin High School
Baldwin High School After School Program
Baptist Collegiate Ministry
BBBS Heart of Ga.
Big Brothers/Big Sisters
Big Brothers/Big Sisters
Bill Ireland YDC
Blandy Hills Elemantary
Boy Scouts
Boy Scouts
Boys & Girls Club
Caring4 Creatures Inc.
Central Georgia Tech.
Central State Hospital
Central State Hospital
CGTC Adult Learning Center
Chaplinwood Nursing Home
Childrens Medical Hospital
Community in Schools of Milledgeville
Compassionate Care Clinic, Inc.
Council of Catholic Women
Covenant Presbyterian Church
Creative Expressions Studio & Gallery
Creative Expressions Studio & Gallery
Crossroads Pregnancy Center
DFACS
Dogwood Retirement Home
Eagle Ridge Elementary School
Early Learning Center
Evergreen Baptist Church
Experience Works, Inc.
Fathers Heart Int. Church, The
First Baptist Church
First Presbyterian Church
Flagg Chapel
Ga Dept of Labor
Ga Dept of Labor
Georgia Cancer Specialist
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia College & State University
Georgia Military College
Georgia Military College
Georgia Power
Georgia War Veterans Home
Georgias Porch
Girl Scouts of Historic Ga
Girl Scouts of Historic Ga
Good Will
Goodwill Industries of Middle Georgia
Goodwill Works
Green Acres Nursing Home
Habitat for Humanity
Habitat For Humanity
Hardwick Baptist Food Pantry
Harolds Department Store
Harriets Closet
Harriets Closet
Historical Society
Hope Lutheran Church
Hopewell United Methodist Church
Hospice Care Options
John Milledge Academy
John Milledge Academy
Josephs Storehouse
Lakeside Baptist Church
Life & Peace Christian Center
Life & Peace Christian Church
Life Enrichment Center
Life Enrichment Center
Lockerly Arboretum
Lockerly Arboretum
MakeAWish Foundation
Meals On Wheels
Meals on Wheels
Midway Elementary
Milledgeville Alumnae Chapter of Delta Sigma Theta Sorority, Inc.
Milledgeville Cares
Milledgeville First United Methodist church
Milledgeville Housing Authority
Milledgeville Jewish Community
Milledgeville Jewish Community
Milledgeville Junior Womens Club
Milledgeville MainStreet
Milledgeville Police Dept
Milledgeville Police Dept
Montpelier United Methodist Church
National Alliance on Mental IllnessOconee
Northside Baptist Church
Oak Hill Middle School
Oak Hill Middle School
Ocmulgee CASA
Oconee Area Citizen Advocacy
Oconee Center
Oconee Center
Oconee Center Community Service Board
Oconee Center comunity Service Board
Oconee Center CSB
Oconee Prevention Resource Council
Oconee Regional Medical Center
Oconee Regional Medical Center
Oconee River Greenway
Old Capital Museum
Overview
Pathfinders Christian Church
Pecan Hills of Milledgeville
Pilot Club
Pilot Club of Milledgeville
Recovery Resources
Relay for Life
River Edge Beh. Health
River Edge Behavioral
Sacred Heart Catholic Church
Salvation Army
Samaritians Inn
Sams Voice
Shiloh Baptist church
Sinclair Baptist Church
Sodexho
Special Olympics
St Patricks
St. Stephens Episcopal Church
St. Stephens Food Pantry
Susan G. Komen Foundation
The Saviors Touch Book Store
The Union Recorder
Thera Pups
Thera Pups
TreBella
Twin Lakes/Mary Vinson Library
Twin Lakes/Mary Vinson Library
Twin Lakes/Mary Vinson Library
Union Recorder
Union Recorder
Union Recorder
United Cerebal Palsy
United Way of Central Ga
Vaughn Chapel Baptist Church
Wal Mart
Walter B. Williams
Wesley Foundation
Westview Baptist Church
Westview Baptist Church
Womens Resource Center
Z97";

mysql_connect('localhost', 'bgs', 'dki2012!');
mysql_select_db('give_ctr_agencies');

$import_array = explode("\n",$import);
$index = 1;

echo $import_array[$index];

foreach($import_array as $temp){
    $query = "UPDATE agency
        SET name = '$temp'
        WHERE id = $index";
    mysql_query($query);
    $index++;
}
echo mysql_error();

?>
