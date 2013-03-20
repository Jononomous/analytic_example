class DataController < ApplicationController
  def index
    @data = MailData.all 
    @rounded_times = @data.map{|t| t.created_at.to_i.round(-3)*1000}
    @histo = histogram(@rounded_times)
  end

  def histogram(times)
    h = Hash.new
    
    #Create a histogram hash of times grouped closely together
    #Inefficient, remove after testing
    times.uniq.each do |time|
      h[time] = 0
    end
    times.each do |time|
      h[time] += 1
    end
    return h
  end
end
