<h1>{$title}</h1>

    {foreach $anArray as $anItem}
        <b>{$anItem}</b>
    {foreachelse}
        <b>notdefined</b>
    {/foreach}
        
    {foreach $anArray.inner as $anotherItem}
        <b>{$anItem}</b>
    {foreachelse}
        <b>notdefined</b>
    {/foreach}
        
<b>notdefined</b>