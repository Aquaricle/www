from django.db import models
from django.forms import ModelForm
from aquariums.models import Aquarium
from equipment.managers import EquipmentManager

class Equipment(models.Model):
    equipmentID = models.AutoField(primary_key=True)
    aquariumID = models.ForeignKey(Aquarium,verbose_name='Aquarium',db_column='aquariumID')
    installDate = models.DateTimeField(verbose_name='Install Date',editable=True,blank=False)
    name = models.CharField(max_length=64,unique=True)
    url = models.URLField(max_length=255,blank=True)
    maintenanceInterval = models.PositiveSmallIntegerField(verbose_name='Maintenance Interval (Days)',null=True,blank=True)
    comments = models.TextField(blank=True)
    def __unicode__(self):
        return unicode(self.name)
    class Meta:
        db_table = 'Equipment'
        verbose_name = 'Equipment'
        verbose_name_plural = 'Equipment'
    objects = EquipmentManager();

class EquipmentLog(models.Model):
    equipmentLogID = models.AutoField(primary_key=True)
    equipmentID = models.ForeignKey(Equipment,verbose_name='Equipment',db_column='equipmentID')
    logDate = models.DateTimeField(verbose_name='Date',editable=True,blank=False)
#    maintenance = EnumField(values=('Yes', 'No'),null=True,blank=False) 
    maintenance = models.CharField(verbose_name='Maintenance',max_length='3',null=False,blank=False) 
#    maintenance = models.PositiveSmallIntegerField(null=True,blank=True)
    action = models.CharField(max_length=24,unique=False)
    class Meta:
        db_table = 'EquipmentLog'
        verbose_name = 'Equipment Log'
        verbose_name_plural = 'Equipment Logs'
        
        
# Model Forms
class EquipmentLogForm(ModelForm):
    class Meta:
        model = EquipmentLog
        exclude = ('equipmentID')