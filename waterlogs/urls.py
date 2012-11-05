from django.conf.urls import patterns, include, url

urlpatterns = patterns('waterlogs.views',
#    url(r'^$', 'index'),
    url(r'^add/(?P<aquarium_id>\d+)/$', 'add_sample'),
    url(r'^(?P<waterlog_id>\d+)/$', 'waterlog_entry'),
)