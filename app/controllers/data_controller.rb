class DataController < ApplicationController
  def index
    @data = MailData.all 
    @rounded_times = @data.map{|t| t.created_at.to_i.round(-3)*1000}
    @histo = histogram(@rounded_times)
  end

  def histogram(times)
    h = Hash.new 0
    times.each{|time| h[time] += 1} 
    return h
  end
end
