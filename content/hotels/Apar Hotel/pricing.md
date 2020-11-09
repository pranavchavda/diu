+++
fragment = "table"
#disabled = false
date = "2017-10-10"
weight = 110
background = "secondary"

title = "Table Fragment"
subtitle= "Tables are responsive by default"
#title_align = "left" # Default is center, can be left, right or center

[header]
  [[header.values]]
    text = "Category"
    # hide_on_mobile = true

  [[header.values]]
    text = "Room Only"

  [[header.values]]
    text = "With Breakfast"
    hide_on_mobile = true

  [[header.values]]
    text = "Breakfast+ Lunch/Dinner"
    hide_on_mobile = true

  [[header.values]]
    text = "Breakfast + Lunch + Dinner"

  [[header.values]]
    text = "Header 6"

[[rows]]
  [[rows.values]]
    header = "Row 1"

  [[rows.values]]
    text = "Value"

  [[rows.values]]
    text = "Long Value"

  [[rows.values]]
    text = "Value"

  [[rows.values]]
    button = "Long Button"
    url = "#"
    color = "success"

  [[rows.values]]
    button = "Button"
    url = "#"
    color = "danger"
    align = "center"

[[rows]]
  [[rows.values]]
    header = "Row 2"

  [[rows.values]]
    text = "Value"

  [[rows.values]]
    text = "Value"

  [[rows.values]]
    text = "Long Value"

  [[rows.values]]
    text = ""

  [[rows.values]]
    icon = "fas fa-download"
    url = "#"
    align = "center"
+++ 