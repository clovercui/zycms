﻿

<div class="commonform" id="saveMember">
<input type="hidden"/> 
  <div class="formtitle">会员添加</div>
  <div class="formtitleline1"></div>
  <div class="formtitleline2"></div>
  <div style="height:20px;"></div>
  
  <table border="0" cellpadding="1" cellspacing="1" style="width:auto; margin-left:120px;">
    <tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red"></span>真实姓名</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="text" name="member.true_name" ng-model="member.true_name" placeholder="真实姓名" /></td>
      <td>&nbsp;</td>
    </tr>
	
	
	
	 <tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red">*</span>用户名</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="text" name="member.username" ng-model="member.username" placeholder="会员用户名" /></td>
      <td>&nbsp;</td>
    </tr>
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red">*</span>密码</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="password" name="member.password" ng-model="member.password" placeholder="会员密码" /></td>
      <td>&nbsp;</td>
    </tr>
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red">*</span>邮箱地址</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="email" name="member.email" ng-model="member.email" placeholder="邮箱地址" /></td>
      <td>&nbsp;</td>
    </tr>
	
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red"></span>收货地址</td>
      <td>&nbsp;</td>
      <td class="okinput k1" style="background:none!important; width:900px;">
			<select name="" style="border:1px solid #ccc;" id="" ng-change="getCities()" ng-model="member.province" ng-options="province.provinceid as province.province for province in provinces">
				<option value="">请选择省份</option>
			</select>
			<select name=""  style="border:1px solid #ccc;" ng-change="getAreas()" ng-show="member.province" ng-model="member.city" id="" ng-options="city.cityid as city.city for city in cities">
				<option value="">请选择市</option>
			</select>
			<select name=""  style="border:1px solid #ccc;" ng-show="member.city" ng-model="member.district" id="" ng-options="area.areaid as area.area for area in areas">
				<option value="">请选择区</option>
			</select>
	  </td>
      <td>&nbsp;</td>
    </tr>
	
	
	
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red"></span>详细地址</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="text" name="member.address" ng-model="member.address" placeholder="详细地址" /></td>
      <td>&nbsp;</td>
    </tr>
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red"></span>手机</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="text" name="member.mobile" ng-model="member.mobile" placeholder="手机" /></td>
      <td>&nbsp;</td>
    </tr>
	
	<tr>
      <td>&nbsp;</td>
      <td align="right"><span class="red"></span>电话</td>
      <td>&nbsp;</td>
      <td class="okinput k1"><input type="text" name="member.phone" ng-model="member.phone" placeholder="电话" /></td>
      <td>&nbsp;</td>
    </tr>
	
	
	
	
   
  </table>
  
  
  <table border="0" cellpadding="1" cellspacing="1" style="width:650px;">
    <tbody><tr>
      <td style="width:5px;"></td>
      <td style="width:100px" align="right">&nbsp;</td>
      <td style="width:10px;">&nbsp;</td>
      <td style="width:200px;">&nbsp;</td>
      <td style="width:3px">&nbsp;</td>
      <td style="width:100px" align="right">&nbsp;</td>
      <td style="width:10px">&nbsp;</td>
      <td align="right"><input type="button" id="submitform" class="buttons button2" ng-hide="isEdit" value="保存" ng-click="addContent();"><input type="button" id="submitform" class="buttons button2" ng-show="isEdit" value="保存" ng-click="modifyContent();"></td>
    </tr>
  </tbody>
	</table>
	

</div>
